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
        $mac = $_POST['mac'];

        $cluster   = Cassandra::cluster()->withContactPoints('192.168.11.4')->build();
        $keyspace  = 'mesh';
        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement(
            "INSERT INTO chat (id, username, mac, body, created_at) VALUES (bbbcb63c-027e-427b-a6e5-b575a79de797, '$name', '$mac', '$msg', now())"
        );
        $future    = $session->executeAsync($statement);
        $session->close();

        return response()->json($future);
    }
}
