
<?php
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $category = Category::create($validatedData);

    return response()->json([
        'message' => 'Category created successfully',
        'data' => $category
    ], 201);
}