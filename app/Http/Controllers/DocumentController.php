<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\DocumentStoreRequest;
use App\Http\Requests\Document\DocumentUpdateRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();

        return response()->json([
            'documents' => $documents,
            'status' => 'success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentStoreRequest $request)
    {
        $document = Document::create($request->all());

        return response()->json([
            'document' => $document,
            'status' => 'success',
            'message' => 'Document stored successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return response()->json([
            'document' => $document,
            'status' => 'success'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $document->update($request->all());

        return response()->json([
            'document' => $document,
            'status' => 'success',
            'message' => 'Document updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        $documents = Document::all();

        return response()->json([
            'documents' => $documents,
            'status' => 'success',
            'message' => 'Document deleted successfully'
        ]);
    }
}
