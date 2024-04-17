<?php
$localhost = '127.0.0.1';
$port = 3306;
$db = 'u423960254_dbcsms';
$user = 'u423960254_root';
$pass = 'marlon090691_023562_C';

$searchQuery = isset($_GET['q']) ? $_GET['q'] : '';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $searchTerms = explode(' ', $searchQuery);
    $conditions = [];

    foreach ($searchTerms as $term) {
        $conditions[] = "firstName LIKE '%$term%' OR lastName LIKE '%$term%' OR userName LIKE '%$term%'";
    }

    $whereClause = implode(' OR ', $conditions);

    $stmt = $pdo->prepare("SELECT * FROM users " . ($whereClause ? "WHERE $whereClause" : ''));
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Handle delete operation
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    try {
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $deleteStmt->bindParam(':id', $deleteId, PDO::PARAM_INT);
        $deleteStmt->execute();
        // Redirect to refresh the page after deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } catch (PDOException $e) {
        echo "Deletion failed: " . $e->getMessage();
    }
}

// Handle edit operation
if (isset($_POST['edit_id']) && isset($_POST['edit_accountType'])) {
    $editId = $_POST['edit_id'];
    $newAccountType = $_POST['edit_accountType'];

    try {
        $editStmt = $pdo->prepare("UPDATE users SET accountType = :accountType WHERE id = :id");
        $editStmt->bindParam(':accountType', $newAccountType, PDO::PARAM_STR);
        $editStmt->bindParam(':id', $editId, PDO::PARAM_INT);
        $editStmt->execute();
        // Redirect to refresh the page after edit
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } catch (PDOException $e) {
        echo "Edit failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.22.0/font/bootstrap-icons.css">
    <title>User Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table tbody tr td,
        .table thead tr th {
            text-align: center;
        }

        /* Add your custom styles here */
        .editable {
            cursor: pointer;
        }

        /* Style for the table heading */
        .table-bordered thead.table-heading th {
            background-color: #007bff;
            color: #ffffff;
            /* White text color */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search users" name="q" value="<?php echo $searchQuery; ?>">
                <button class="btn btn-outline-secondary btn-sm" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        <div class="d-flex justify-content-center">
            <table class="table table-bordered">
                <thead class="thead-dark table-heading">
                    <tr>
                        <th>Picture</th>
                        <th>Account Type</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td>
                                <?php
                                $picturePath = $row['picture_data'];
                                echo '<img src="' . $picturePath . '" alt="Profile Picture" width="50" height="50">';
                                ?>
                            </td>
                            <td class="editable" style="background-color:#FFFFE0; white-space: nowrap;" id="accountType-<?php echo $row["id"]; ?>">
                                <?php echo $row["accountType"]; ?>
                            </td>
                            <td style="white-space: nowrap;"><?php echo $row['firstName']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['lastName']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['userName']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['email']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['phoneNumber']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['birthdate']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['Age']; ?></td>
                            <td style="white-space: nowrap;"><?php echo $row['address']; ?></td>
                            <td class="d-flex align-items-center">

                                <button class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $row["id"]; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-warning delete-btn">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>

                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal-<?php echo $row["id"]; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit User Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Add your edit form here -->
                                        <form method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                            <div class="row g-3">
                                                <div class="col-4">
                                                    <label for="editAccountType" class="form-label">Account Type</label>
                                                    <input type="text" class="form-control" id="editAccountType" name="edit_accountType" placeholder="Enter new account type" value="<?php echo $row['accountType']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editFirstName" class="form-label">Firstname</label>
                                                    <input type="text" class="form-control" id="editFirstName" name="edit_firstName" placeholder="Enter new firstname" value="<?php echo $row['firstName']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editLastName" class="form-label">Lastname</label>
                                                    <input type="text" class="form-control" id="editLastName" name="edit_lastName" placeholder="Enter new lastname" value="<?php echo $row['lastName']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editUserName" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="editUserName" name="edit_userName" placeholder="Enter new username" value="<?php echo $row['userName']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editEmail" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="editEmail" name="edit_email" placeholder="Enter new email" value="<?php echo $row['email']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" id="editPhoneNumber" name="edit_phoneNumber" placeholder="Enter new phone number" value="<?php echo $row['phoneNumber']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editBirthdate" class="form-label">Birthdate</label>
                                                    <input type="date" class="form-control" id="editBirthdate" name="edit_birthdate" value="<?php echo $row['birthdate']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editAge" class="form-label">Age</label>
                                                    <input type="number" class="form-control" id="editAge" name="edit_age" placeholder="Enter new age" value="<?php echo $row['Age']; ?>">
                                                </div>
                                                <div class="col-4">
                                                    <label for="editAddress" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="editAddress" name="edit_address" placeholder="Enter new address" value="<?php echo $row['address']; ?>">
                                                </div>
                                            </div> <br>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>