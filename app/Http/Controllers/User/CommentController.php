<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only('user_id', 'target_id', 'content', 'type');
            try {
                $comment = $this->commentRepository->create($input);
                $target = $this->commentRepository->updateTargetComment($input);
                $result = [
                    'success' => true,
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'message' => trans('home.comment_fail'),
                ];
                return response()->json($result);
            }
            return response()->json($result);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($request->ajax()) {
            $input = $request->only('id');
            try {
                $comment = $this->commentRepository->delete($id);
                $result = [
                    'success' => true,
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'message' => trans('label.edit_comment_fail'),
                ];

                return response()->json($result);
            }

            return response()->json($result);
        }

        return redirect()->back();
    }

    public function updateComment(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only('id', 'content');
            try {
                $comment = $this->commentRepository->updateComment($input);
                $result = [
                    'success' => true,
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'message' => trans('label.edit_comment_fail'),
                ];

                return response()->json($result);
            }

            return response()->json($result);
        }

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only('id');
            try {
                $comment = $this->commentRepository->delete($input['id']);
                $target = $this->commentRepository->updateAfterDeleteComment($input['id']);
                $result = [
                    'success' => true,
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'message' => trans('label.edit_comment_fail'),
                ];

                return response()->json($result);
            }

            return response()->json($result);
        }

        return redirect()->back();
    }
}
