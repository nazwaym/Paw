<?php
// If-Else
$nilai = 85;
if ($nilai >= 90) {
    echo "Grade: A<br>";
} elseif ($nilai >= 75) {
    echo "Grade: B<br>";
} else {
    echo "Grade: C<br>";
}

echo "<hr>";

// For loop
for ($i = 0; $i < 5; $i++) {
    echo "for: $i<br>";
}

echo "<hr>";

// While loop
$i = 0;
while ($i < 5) {
    echo "while: $i<br>";
    $i++;
}

echo "<hr>";

// Foreach (array)
$buah = array("apel", "pisang", "jeruk");
foreach ($buah as $item) {
    echo "buah: $item<br>";
}
?>
