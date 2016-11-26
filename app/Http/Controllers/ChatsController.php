<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cassandra;

class ChatsController extends Controller
{
    public function getMessages() {
        $cluster   = Cassandra::cluster()->withContactPoints('172.17.0.2')->build();
        $keyspace  = 'mesh';

        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement("SELECT * FROM chat");
        $future    = $session->executeAsync($statement);
        $result    = $future->get();

        return view('chatdata', compact('result'));
    }

    public function sendMessages() {
        $name = $_POST['username'];
        $msg = $_POST['body'];

        $cluster   = Cassandra::cluster()->withContactPoints('172.17.0.2')->build();
        $keyspace  = 'mesh';
        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement(
            "INSERT INTO chat (id, username, body, created_at) VALUES (cd609ead-7cae-4830-89c0-cdba47937396, '$name', '$msg', now())"
        );
        $future    = $session->executeAsync($statement);
        $session->close();

        return response()->json($future);
    }
}
