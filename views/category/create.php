<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
    <h2>Add Category</h2>
    <form action="/public/index.php?view=category/create" method="post">
        <label for="name">Category Name:</label>
        <input type="text" name="name" required><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>
