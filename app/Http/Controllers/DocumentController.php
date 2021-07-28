<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use App\Models\Agency;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        if ($user->hasRole('super admin')) {
            $documents = Document::get();
        } else if ($user->hasRole('admin')) {
            $documents = Document::where('agency_id', $user->employee->agency_id)->get();
        } else {
            $documents = Document::where('employee_id', $user->employee->id)->get();
        }

        return view('document.table', compact('documents', 'user'));
    }

    public function create()
    {

        return view('document.create', [
            'document' => new Document(),
            'years' => Year::get(),
            'categories' => DocumentCategory::get(),
            'submit' => 'Create',
        ]);
    }

    public function download(Document $document)
    {
        $agency = Agency::find($document->agency_id);
        $filePath = public_path("documents/{$agency->name}/$document->file");
        if ($filePath === null) {
            abort('404');
        }
        return response()->download($filePath);
    }

    function saveFile(Request $request, $agencyID)
    {
        $fileName = null;
        $category = DocumentCategory::find(request('category_id'));
        $agency = Agency::find($agencyID);

        $names = explode('.', $request->file->getClientOriginalName());
        if ($request->file) {
            $fileName = $names[0] . '-' . time() . '-' . request('no') . '-' . $category->category
                . '.' . $request->file->extension();
            $request->file->move(public_path('documents/' . $agency->name), $fileName);
        }

        return $fileName;
    }

    public function store()
    {
        request()->validate([
            'no' => 'required',
            'desc' => 'required',
            'year_id' => 'required',
            'category_id' => 'required',
            'file' => 'required|mimes:pdf, jpg, png, doc, docx|max:5120',
        ]);

        $user = Auth::user();
        $user = User::find($user->id);
        $employeeID = $user->employee->id;
        $agencyID = $user->employee->agency_id;

        $fileName = $this->saveFile(request(), $agencyID);

        $document = Document::create([
            'no' => request('no'),
            'desc' => request('desc'),
            'file' => $fileName,
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
        $user = User::find($user->id);

        if ($user->id !== $document->employee->id && !$user->hasRole(['super admin', 'admin'])) {
            abort('403');
        }

        return view('document.edit', [
            'document' => $document,
            'years' => Year::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Document $document)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        if ($user->id !== $document->employee->id && !$user->hasRole(['super admin', 'admin'])) {
            abort('403');
        }

        request()->validate([
            'no' => 'required',
            'desc' => 'required',
            'year_id' => 'required',
            'category_id' => 'required',
        ]);

        $oldDocument = $document->no;

        $document->update([
            'no' => request('no'),
            'desc' => request('desc'),
            'year_id' => request('year_id'),
            'document_category' =>  request('category_id'),
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
        } else {
            abort('404');
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
