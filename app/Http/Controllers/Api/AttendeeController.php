<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller {

    /**
 * @OA\Get(
 *     path="/api/attendees",
 *     summary="Get list of attendees",
 *     tags={"Attendees"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Attendee")
 *         )
 *     )
 * )
 */
    public function index() {
        return Attendee::all();
    }

    /**
     * @OA\Post(
     *     path="/api/attendees",
     *     summary="Create a new ",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     * )
     */
    public function store(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:attendees,email',
            ]);
            
            return Attendee::create($data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function show(Attendee $attendee) {
        return $attendee;
    }

    /**
     * @OA\Put(
     *     path="/api/attendees/{id}",
     *     summary="Update an attendee",
     *     tags={"Attendees"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the attendee to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Name"),
     *             @OA\Property(property="email", type="string", example="updated@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update",
     *         @OA\JsonContent(ref="#/components/schemas/Attendee")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Attendee not found"
     *     )
     * )
     */
    public function update(Request $request, int $id) {
        try {
            $attendee = Attendee::findOrFail($id);
            $data = $request->validate([
                'name' => 'sometimes|string',
                'email' => 'sometimes|email|unique:attendees,email,' . $attendee->id,
            ]);
            $attendee->update($data);
            return $attendee;
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/attendees/{id}",
     *     summary="Delete an attendee",
     *     tags={"Attendees"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the attendee to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Attendee deleted",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Attendee deleted")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Attendee not found"
     *     )
     * )
     */
    public function destroy(int $id) {
        $attendee = Attendee::findOrFail($id);
        $attendee->delete();
        return response()->json(['message' => 'Attendee deleted']);
    }
}
