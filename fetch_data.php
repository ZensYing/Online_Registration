<?php
include 'db.php';

// Fetch the draw and search values from DataTables
$draw = intval($_POST['draw']);
$searchValue = $_POST['search']['value'];

// Set the default values for the query
$start = intval($_POST['start']);
$length = intval($_POST['length']);
$orderBy = $_POST['columns'][intval($_POST['order'][0]['column'])]['data'];
$orderDir = $_POST['order'][0]['dir'];

// Prepare the SQL query with the search value, if it exists
$sql = "SELECT * FROM tblpersonalinformation";
if ($searchValue != "") {
  $sql .= " WHERE StudentNameKH LIKE '%$searchValue%' OR StudentNameEN LIKE '%$searchValue%'";
}
$sql .= " ORDER BY $orderBy $orderDir";
$sql .= " LIMIT $start, $length";

// Execute the query and fetch the results
$result = mysqli_query($conn, $sql);
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
  // Add the action buttons to the row data
  $row['Actions'] = '<a href="#" onclick="showSweetAlert( ... )" class="inline-flex items-center ...">See more</a>';

  // Add the photo as an image element to the row data
  $row['Photo'] = '<img src="studentinfo/' . $row['Photo'] . '" class="h-8 w-8 rounded-full">';

  $data[] = $row;
}

// Fetch the total number of records in the table
$sqlTotalRecords = "SELECT COUNT(*) as total FROM tblpersonalinformation";
$resultTotalRecords = mysqli_query($conn, $sqlTotalRecords);
$totalRecords = mysqli_fetch_assoc($resultTotalRecords)['total'];

// Fetch the total number of filtered records
$sqlFilteredRecords = "SELECT COUNT(*) as total FROM tblpersonalinformation";
if ($searchValue != "") {
  $sqlFilteredRecords .= " WHERE StudentNameKH LIKE '%$searchValue%' OR StudentNameEN LIKE '%$searchValue%'";
}
$resultFilteredRecords = mysqli_query($conn, $sqlFilteredRecords);
$filteredRecords = mysqli_fetch_assoc($resultFilteredRecords)['total'];

// Return the JSON response for DataTables
$response = array(
  "draw" => $draw,
  "recordsTotal" => $totalRecords,
  "recordsFiltered" => $filteredRecords,
  "data" => $data
);

echo json_encode($response);
?>