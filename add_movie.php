<?php
include 'wala.php';

// Retrieve form data
$title = $_POST['title'];
$genre = $_POST['genre'];
$release_date = $_POST['release_date'];
$duration = $_POST['duration'];
$rating = $_POST['rating'];
$movie_price = $_POST['movie_price'];
$status = $_POST['status'];
$tmdb_id = $_POST['tmdb_id'];
$overview = $_POST['overview'];

// Prepare insert query
$sql = "INSERT INTO movie (title, genre, release_date, duration, rating, movie_price, status, tmdb_id, overview) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssdsss", $title, $genre, $release_date, $duration, $rating, $movie_price, $status, $tmdb_id, $overview);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'insert_id' => $conn->insert_id,
        'data' => [
            'id' => $conn->insert_id,
            'title' => $title,
            'genre' => $genre,
            'release_date' => $release_date,
            'duration' => $duration,
            'rating' => $rating,
            'movie_price' => $movie_price,
            'status' => $status,
            'tmdb_id' => $tmdb_id,
            'overview' => $overview
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add movie.']);
}
?>
