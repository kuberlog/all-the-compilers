<?hh <<__EntryPoint>> function main(): void {
$host   = getenv("MYSQL_TEST_HOST")   ? getenv("MYSQL_TEST_HOST") : "localhost";
$port   = getenv("MYSQL_TEST_PORT")   ? getenv("MYSQL_TEST_PORT") : 3306;
$user   = getenv("MYSQL_TEST_USER")   ? getenv("MYSQL_TEST_USER") : "root";
$passwd = getenv("MYSQL_TEST_PASSWD") ? getenv("MYSQL_TEST_PASSWD") : "";
$db     = getenv("MYSQL_TEST_DB")     ? getenv("MYSQL_TEST_DB") : "test";

$pdo = new PDO("mysql:dbname=$db;host=$host", $user, $passwd);

$p = $pdo->prepare("SELECT 3");
$p->execute();
$p->bindColumn(1, $three);
$p->fetch(PDO::FETCH_BOUND);

var_dump($three);
}