// public/assets/js/supabase-config.js
const SUPABASE_URL = 'https://qrimlbomhytczhijamml.supabase.co';
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFyaW1sYm9taHl0Y3poaWphbW1sIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzQwMTU0MzMsImV4cCI6MjA4OTU5MTQzM30.fhAKfjfMHwBvEdSykKiOup1vvjQ5VUavPg1Hs0Ue104';

// Create client
const supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

// Attach to window
window.supabase = supabaseClient;

console.log('Supabase initialized:', window.supabase ? '✅' : '❌');