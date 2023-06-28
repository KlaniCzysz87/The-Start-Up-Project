<?php

// The Start-Up Project

// Include necessary files
include_once 'Database.php';
include_once 'Verification.php';

// Establish a connection to the database
$db = Database::getInstance();
$connection = $db->getConnection();


// Function to create a new user
function createUser($name, $email, $password) { 
	// Create a new verification instance
	$verify = new Verification($connection);

	// Create a new user hash
	$hash = $verify->createHash($name, $email, $password);

	// Prepare the query
	$query = "INSERT INTO Users (name, email, password, hash) 
				VALUES (:name, :email, :password, :hash)";
	$statement = $connection->prepare($query);

	// Bind the parameters
	$statement->bindParam(':name', $name);
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	$statement->bindParam(':hash', $hash);

	// Execute the query
	$statement->execute();
}


// Function to retrieve a user by their ID
function getUserById($id) {
	// Prepare the query
	$query = "SELECT * FROM Users WHERE id = :id";
	$statement = $connection->prepare($query);

	// Bind the parameters
	$statement->bindParam(':id', $id);

	// Execute the query
	$statement->execute();

	// Return the result
	return $statement->fetch(PDO::FETCH_ASSOC);
}


// Function to authenticate a user
function authenticateUser($email, $password) {
	// Create a new verification instance
	$verify = new Verification($connection);

	// Authenticate the user
	return $verify->authenticate($email, $password);
}


// Function to generate an access token
function generateAccessToken() {
	// Create a new verification instance
	$verify = new Verification($connection);

	// Generate the access token
	return $verify->generateAccessToken();
}


// Function to update a user profile
function updateUserProfile($id, $name, $email, $password, $access_level) {
	// Prepare the query
	$query = "UPDATE Users SET name = :name, email = :email, 
				password = :password, access_level = :access_level 
				WHERE id = :id";
	$statement = $connection->prepare($query);

	// Bind the parameters
	$statement->bindParam(':name', $name);
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	$statement->bindParam(':access_level', $access_level);
	$statement->bindParam(':id', $id);

	// Execute the query
	$statement->execute();
}


// Function to revoke an access token
function revokeAccessToken($access_token) {
	// Prepare the query
	$query = "UPDATE Users SET access_token = :access_token 
				WHERE access_token = :access_token";
	$statement = $connection->prepare($query);

	// Bind the parameters
	$statement->bindParam(':access_token', $access_token);

	// Execute the query
	$statement->execute();
}


// Function to retrieve a user by their access token
function getUserByAccessToken($access_token) {
	// Prepare the query
	$query = "SELECT * FROM Users WHERE access_token = :access_token";
	$statement = $connection->prepare($query);

	// Bind the parameters
	$statement->bindParam(':access_token', $access_token);

	// Execute the query
	$statement->execute();

	// Return the result
	return $statement->fetch(PDO::FETCH_ASSOC);
}


// Function to log a user out
function logoutUser($access_token) {
	// Revoke the user's access token 
	revokeAccessToken($access_token);
}

?>