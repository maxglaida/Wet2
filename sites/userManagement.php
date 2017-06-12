<?php
if ($_SESSION['priviliges'] == 2) {
    include '../model/User.php';
    if (isset($_GET['userid']) && isset($_GET['status'])) {
        $db->deActivateUser($_GET['userid'], $_GET['status']);
    }

    $allUsers = $db->getUserList();
    ?>
    <div class="container col-md-12">
        <h3>User management</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Full address</th>
                    <th>Payment method</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($allUsers as $oneUser) {
                    if ($oneUser->getStatus() == 1) {
                        $userStatus = "active";
                    } else
                        $userStatus = "inactive";
                    echo "<tr>";
                    echo "<td>" . $oneUser->getUsername() . "</td>";
                    echo "<td>" . $oneUser->getGender() . "</td>";
                    echo "<td>" . $oneUser->getSurname() . " " . $oneUser->GetName() . "</td>";
                    echo "<td>" . $oneUser->getEmail() . "</td>";
                    echo "<td>" . $oneUser->getAddress() . ", " . $oneUser->getZip() . ", " . $oneUser->getCity() . "</td>";
                    echo "<td>" . $oneUser->getPayment() . "</td>";
                    echo "<td> $userStatus </td>";
                    echo "<td><a href='index.php?id=7&userid=" . $oneUser->getId() . "&status=" . $oneUser->getStatus() . "' class='btn btn-primary btn-sm active' role='button'>Activate/Deactivate</a></td>";
                    echo "<td><a href='index.php?id=9&userid=" . $oneUser->getId() . "' class='btn btn-primary btn-sm active' role='button'>Show orders</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <?php
} else
    header("location: index.php");

