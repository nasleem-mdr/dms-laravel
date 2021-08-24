<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use App\Models\Agency;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use App\Rules\DocumentNumberFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super admin')) {
            $documents = Document::with('employee', 'year', 'document_category', 'agency')->get();
        } else {
            $documents = Document::with('employee', 'year', 'document_category', 'agency')->where('agency_id', $user->employee->agency_id)->get();
        }

        return view('document.table', compact('documents', 'user'));
    }

    public function create()
    {
        $user = Auth::user();

        $agencies = null;
        if ($user->hasRole('super admin')) {
            $agencies = Agency::get();
        }

        return view('document.create', [
            'user' => $user,
            'document' => new Document(),
            'agencies' => $agencies,
            'years' => Year::get(),
            'categories' => DocumentCategory::get(),
            'submit' => 'Create',
        ]);
    }

    public function download(Document $document)
    {
        $agency = Agency::find($document->agency_id);
        $filePath = $document->file;
        if ($filePath === null) {
            abort('404');
        }
        return response()->download($filePath);
    }

    function saveFile(Request $request, $agencyID)
    {
        $category = DocumentCategory::find(request('category_id'));
        $year = Year::find(request('year_id'));
        $agency = Agency::find($agencyID);
        $fileName = null;
        if ($request->file) {
            $fileName = $request->no . '-' . $category->category . '-' . $year->year
                . '.' . $request->file->extension();
            $location = $request->file->move(public_path('documents/' . $agency->id, '/' . $year->year . '/'), $fileName);
            // $location = $request->file->move('documents/' . $agency->id . '/' . $year->year . '/', $fileName); // production
        }

        return $location;
    }

    public function store()
    {
        request()->validate([
            'no' => ['required', 'unique:documents', new DocumentNumberFormat()],
            'desc' => 'required|string',
            'year_id' => 'required',
            'category_id' => 'required',
            'file' => 'required|mimes:pdf, jpg, png, doc, docx, xlsx|max:5120',
        ]);

        $user = Auth::user();

        $employeeID = $user->employee->id;
        $agencyID = $user->employee->agency_id;

        if ($user->hasRole('super admin')) {
            request()->validate([
                'agency_id' => 'required',
            ]);
            $employeeID = $user->employee->id;
            $agencyID = request('agency_id');
        }

        $location = $this->saveFile(request(), $agencyID);

        $document = Document::create([
            'no' => request('no'),
            'desc' => request('desc'),
            'file' => $location,
            'year_id' => request('year_id'),
            'employee_id' => $employeeID,
            'agency_id' => $agencyID,
            'document_category_id' =>  request('category_id'),
        ]);

        return redirect()->route('document.table')->with('success', "{$document->file} berhasil ditambahkan");
    }

    public function edit(Document $document)
    {
        $user = Auth::user();

        $agencies = new Agency();
        if ($user->hasRole('super admin')) {
            $agencies = Agency::get();
        }

        return view('document.edit', [
            'user' => $user,
            'categories' => DocumentCategory::get(),
            'document' => $document,
            'years' => Year::get(),
            'submit' => 'Update',
            'agencies' => $agencies,
        ]);
    }

    public function update(Document $document)
    {
        $user = Auth::user();

        request()->validate([
            'no' => 'required',
            'desc' => 'required',
            'year_id' => 'required',
            'category_id' => 'required',
        ]);

        $oldDocument = $document->no;

        $fileName = $document->file;
        if (request('file') !== null) {
            $agencyID = $document->employee->agency->id;
            $fileName = $this->saveFile(request(), $agencyID);
        }

        $document->update([
            'no' => request('no'),
            'desc' => request('desc'),
            'year_id' => request('year_id'),
            'document_category' =>  request('category_id'),
            'file' => $fileName,
        ]);

        return redirect()->route('document.table')->with('success', "Arsip No. {$oldDocument} telah diperbaruhi menjadi {$document->no}");
    }

    public function deleteFile(Document $document)
    {
        $agency = Agency::find($document->agency_id);
        $filePath = public_path("documents/{$agency->name}/$document->file");
        if (File::exists($filePath)) {
            File::delete($filePath);
            return;
        }
    }

    public function destroy(Document $document)
    {
        $tempDocument = $document->no;
        $this->deleteFile($document);
        $document->delete();
        return redirect()->route('document.table')->with('success', "Arsip No. {$tempDocument} telah dihapus");
    }
}
