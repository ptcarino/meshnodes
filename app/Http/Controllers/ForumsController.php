<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cassandra;

class ForumsController extends Controller
{
    public function index() {
        $cluster   = Cassandra::cluster()->build();
        $keyspace  = 'mesh';

        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement("SELECT * FROM bulletin");
        $future    = $session->executeAsync($statement);
        $result    = $future->get();

        $rations_stmt = new Cassandra\SimpleStatement("SELECT * FROM bulletin WHERE topic_id = f96a1c8c-275d-4a9e-b876-15ce78f82009");
        $rations_count = $session->execute($rations_stmt)->count();

        $rlast_stmt = new Cassandra\SimpleStatement("SELECT username, post_title FROM bulletin WHERE topic_id = f96a1c8c-275d-4a9e-b876-15ce78f82009 ORDER BY created_at DESC");
        $rlast = $session->execute($rlast_stmt)->first();

        $rescue_stmt = new Cassandra\SimpleStatement("SELECT * FROM bulletin WHERE topic_id = 9aae61d1-9df9-4cd2-b471-9494f9f9564d");
        $rescue_count = $session->execute($rescue_stmt)->count();

        $rclast_stmt = new Cassandra\SimpleStatement("SELECT username, post_title FROM bulletin WHERE topic_id = 9aae61d1-9df9-4cd2-b471-9494f9f9564d ORDER BY created_at DESC");
        $rclast = $session->execute($rclast_stmt)->first();

        return view('forum.index', compact('result', 'rations_count', 'rescue_count', 'rlast', 'rclast'));
    }

    public function rations() {
        $cluster   = Cassandra::cluster()->build();
        $keyspace  = 'mesh';

        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement("SELECT * FROM bulletin");
        $future    = $session->executeAsync($statement);
        $result    = $future->get();

        return view('forum.rations');
    }

    public function rescue() {

    }
}
