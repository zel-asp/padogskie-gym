<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Supabase\SupabaseClient;

// Your Supabase credentials
$supabaseUrl = 'https://qrimlbomhytczhijamml.supabase.co';
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFyaW1sYm9taHl0Y3poaWphbW1sIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzQwMTU0MzMsImV4cCI6MjA4OTU5MTQzM30.fhAKfjfMHwBvEdSykKiOup1vvjQ5VUavPg1Hs0Ue104';

// Initialize Supabase client
$supabase = new SupabaseClient($supabaseUrl, $supabaseKey); 

// Optional: Get database connection details from Supabase
// Go to Project Settings → Database → Connection Pooling
// You'll need to get these from your Supabase dashboard:
$dbHost = 'aws-0-ap-southeast-1.pooler.supabase.com'; // or your specific region
$dbPort = '6543'; // Use 6543 for transaction pooler
$dbName = 'postgres';
$dbUser = 'postgres.qrimlbomhytczhijamml'; // format: postgres.[project-id]
$dbPassword = 'your-database-password'; // Get from database settings

// PostgreSQL PDO connection (alternative)
try {
    $pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to Supabase PostgreSQL successfully!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>