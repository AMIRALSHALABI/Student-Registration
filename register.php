<!DOCTYPE html>
<html>

<head>
    <title>Student Registration Form - Result</title>
</head>

<body>
    <?php
function validateFormData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Query that used to create table in SQL
// "CREATE TABLE students (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   full_name VARCHAR(50) NOT NULL,
//   email VARCHAR(50) NOT NULL,
//   gender ENUM('Male', 'Female') NOT NULL
// )";

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "student";
$database = new 
PDO("mysql:host=localhost;dbname=student; charsetutf8;",$username,$password); 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
  
  $fullname = validateFormData($_POST["fullname"]);
  $email = validateFormData($_POST["email"]);
  $gender = validateFormData($_POST["gender"]);

  
 
  $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$fullname', '$email', '$gender')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "Registration successful!";
    $sql = "SELECT * FROM students";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Students list </h2>";
  echo "<table>";
  echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Gender</th></tr>";

  while ($row = $result->
  fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["full_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["gender"] . "</td>";
    echo "</tr>";
}
echo "</table>";
} else {
echo "No registered students.";
}
  
} else {
    echo "Error: " . mysqli_error($conn);
}
}

?>
</body>

</html>