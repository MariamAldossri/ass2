<?php
// API Endpoint URL
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from the API
$response = @file_get_contents($api_url);

// Check if the API returned data
if ($response === false) {
    die("Error: Unable to fetch data from the API. Please check the URL or your network connection.");
}

// Decode JSON response
$data = json_decode($response, true);

// Extract the "results" array from the API response
$records = $data['results'] ?? []; // Use 'results' based on your example JSON
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationalities</title>
    <!-- Link Pico CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
</head>
<body>
    <header>
        <h1>University of Bahrain Students by Nationality</h1>
        <h4>Mariam ALDOSSRI   20157513</h4>
    </header>
    <main>
        <?php if (!empty($records)): ?>
            <table>
                <thead>
                    <tr>
                        <th>College</th>
                        <th>Program</th>
                        <th>Nationality</th>
                        <th>Number of Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <?php
                        // Extract fields from each record
                        $college = $record['colleges'] ?? 'N/A';
                        $program = $record['the_programs'] ?? 'N/A';
                        $nationality = $record['nationality'] ?? 'N/A';
                        $students_count = $record['number_of_students'] ?? 'N/A';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($college); ?></td>
                            <td><?php echo htmlspecialchars($program); ?></td>
                            <td><?php echo htmlspecialchars($nationality); ?></td>
                            <td><?php echo htmlspecialchars($students_count); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No data available. Please check the API response or filters.</p>
        <?php endif; ?>
    </main>
</body>
</html>
