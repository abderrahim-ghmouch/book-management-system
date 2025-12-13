<?php
require_once "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>View Books</title>
</head>
<body class="bg-cyan-800 min-h-screen p-8">

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <header class="text-center mb-10">
        <h1 class="text-4xl font-bold text-white mb-4">📚 All Books</h1>
        <div class="flex justify-center gap-4">
            <a href="index.php" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                ← Back to Add Book
            </a>
        </div>
    </header>


    <main class="bg-white rounded-2xl shadow-2xl p-6">
        <?php
        try {
            // Fetch all books from database
            $stmt = $dbase->query("SELECT * FROM book ORDER BY id DESC");
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($books) > 0):
        ?>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Book Title</th>
                        <th class="p-4 text-left">Author</th>
                        <th class="p-4 text-left">Year</th>
                        <th class="p-4 text-left">Read</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                    <!-- Display Row -->
                    <tr class="border-b hover:bg-gray-50" id="book-row-<?php echo $book['id']; ?>">
                        <td class="p-4"><?php echo htmlspecialchars($book['id']); ?></td>
                        <td class="p-4 font-medium"><?php echo htmlspecialchars($book['book']); ?></td>
                        <td class="p-4"><?php echo htmlspecialchars($book['author']); ?></td>
                        <td class="p-4"><?php echo htmlspecialchars($book['published']); ?></td>
                        <td class="p-4">
                            <?php if($book['isRead'] == 1): ?>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">✓ Read</span>
                            <?php else: ?>
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">Unread</span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <!-- Edit Button -->
                                <button 
                                    onclick="showEditForm(<?php echo $book['id']; ?>, '<?php echo htmlspecialchars(addslashes($book['book'])); ?>', '<?php echo htmlspecialchars(addslashes($book['author'])); ?>', '<?php echo $book['published']; ?>', <?php echo $book['isRead']; ?>)"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                                >
                                    ✏️ Edit
                                </button>
                                
                                <!-- Delete Button -->
                                <a href="del.php?id=<?php echo $book['id']; ?>" 
                            
                                   class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                    🗑️ Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Edit Form Row (Hidden by default) -->
                    <tr id="edit-form-<?php echo $book['id']; ?>" class="hidden bg-blue-50">
                        <td colspan="6" class="p-4">
                            <form action="update.php" method="POST" class="space-y-4" onsubmit="return handleUpdate(event, <?php echo $book['id']; ?>)">
                                <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Book Title</label>
                                        <input 
                                            type="text" 
                                            name="title" 
                                            value="<?php echo htmlspecialchars($book['book']); ?>"
                                            class="w-full border border-gray-300 rounded-lg p-2"
                                            required
                                        >
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                                        <input 
                                            type="text" 
                                            name="author" 
                                            value="<?php echo htmlspecialchars($book['author']); ?>"
                                            class="w-full border border-gray-300 rounded-lg p-2"
                                            required
                                        >
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                                        <input 
                                            type="number" 
                                            name="published" 
                                            value="<?php echo htmlspecialchars($book['published']); ?>"
                                            min="1000" 
                                            max="2025"
                                            class="w-full border border-gray-300 rounded-lg p-2"
                                        >
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center">
                                        <input 
                                            type="checkbox" 
                                            name="is_read" 
                                            value="1"
                                            id="read-<?php echo $book['id']; ?>"
                                            class="h-4 w-4 text-blue-600"
                                            <?php echo ($book['isRead'] == 1) ? 'checked' : ''; ?>
                                        >
                                        <label for="read-<?php echo $book['id']; ?>" class="ml-2 text-gray-700">
                                            I have read this book
                                        </label>
                                    </div>
                                    
                                    <div class="flex gap-2 ml-auto">
                                        <button 
                                            type="submit" 
                                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
                                        >
                                            💾 Save
                                        </button>
                                        <button 
                                            type="button" 
                                            onclick="hideEditForm(<?php echo $book['id']; ?>)"
                                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition"
                                        >
                                            ↩️ Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php else: ?>
        
        <div class="text-center py-12">
            <div class="text-gray-400 text-6xl mb-4">📚</div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">No Books Yet</h3>
            <p class="text-gray-500 mb-6">Add your first book to get started!</p>
            <a href="index.php" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition">
                ➕ Add Your First Book
            </a>
        </div>
        
        <?php endif; ?>
        
        <?php
        } catch(PDOException $e) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">';
            echo 'Error loading books: ' . $e->getMessage();
            echo '</div>';
        }
        ?>
        
        <!-- Summary -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-600">
                <strong>Total Books:</strong> <?php echo count($books); ?> |
                <strong>Read:</strong> <?php 
                    $read = array_filter($books, function($book) {
                        return $book['isRead'] == 1;
                    });
                    echo count($read);
                ?> |
                <strong>Unread:</strong> <?php echo count($books) - count($read); ?>
            </p>
        </div>
    </main>
</div>


<script>
// Show edit form
function showEditForm(id, book, author, published, isRead) {
    // Hide all other edit forms first
    document.querySelectorAll('[id^="edit-form-"]').forEach(form => {
        form.classList.add('hidden');
    });
    
    // Show all display rows
    document.querySelectorAll('[id^="book-row-"]').forEach(row => {
        row.classList.remove('hidden');
    });
    
    // Hide the display row and show edit form for this book
    document.getElementById('book-row-' + id).classList.add('hidden');
    document.getElementById('edit-form-' + id).classList.remove('hidden');
}

function hideEditForm(id) {
    document.getElementById('edit-form-' + id).classList.add('hidden');
    document.getElementById('book-row-' + id).classList.remove('hidden');
}


function handleUpdate(event, id) {
    event.preventDefault(); 
    
    const form = event.target;
    const formData = new FormData(form);
    
    
    fetch('update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if(data.includes('success') || data.includes('✅')) {
            // Reload page to see updated data
            window.location.reload();
        } else {
            alert('Update failed: ' + data);
        }
    })
    .catch(error => {
        alert('Error: ' + error);
    });
    
    return false;
}
</script>

</body>
</html>