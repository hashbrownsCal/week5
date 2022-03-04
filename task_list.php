<?php include('./view/header.php') ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Tasks
        </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_tasks">
            <select name="category_id" required>
                <option value="0">View All</option>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category_id == $category['categoryID']) { ?>
                        <option value="<?= $category['categoryID'] ?>" selected>
                        <?php } else { ?>
                        <option value="<?= $category['categoryID'] ?>">
                        <?php } ?>
                        <?= $category['categoryName'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
    <?php if ($tasks) { ?>
        <?php foreach ($tasks as $task) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= "{$task['Title']}" ?></p>
                    <p><?= $task['Description']; ?></p>
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_task">
                        <input type="hidden" name="task_id" value="<?= $task['ItemNum']; ?>">
                        <button class="remove-button">❌</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <br>
        <?php if ($category_id) { ?>
            <p>No tasks exist for this category yet.</p>
        <?php } else { ?>
            <p>No tasks exist yet.</p>
        <?php } ?>
        <br>
    <?php } ?>
</section>

<br>

<section id="add" class="add">
    <h2>Add Task</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_task">
        <div class="add__inputs">
            <label>Category:</label>
            <select name="category_id" required>
                <option value="">Please select</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['categoryID']; ?>">
                        <?= $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Title:</label>
            <input type="text" name="title" maxlength="120" placeholder="Title" required>
            <label>Description:</label>
            <input type="text" name="description" maxlength="120" placeholder="Description" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_categories">View/Edit Categories</a></p>
<?php include('./view/footer.php') ?>