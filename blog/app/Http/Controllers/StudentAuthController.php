<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class StudentAuthController extends Controller
{
    private $baseURL = "https://pupt-registration.site";
    private $API_KEY = "pup_sjXDT8odELYV71pVfirvFRziLgs5G6y1_1755770032";

    public function showLoginForm()
    {
        return view('auth.student-login'); // your Blade file
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $client = new Client(['base_uri' => $this->baseURL]);

        try {
            $response = $client->post('/api/auth/login', [
                'json' => [
                    'email'    => $request->email,
                    'password' => $request->password,
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-API-Key'    => $this->API_KEY,
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['success']) && $body['success'] === true) {
                $data = $body['data'];
                $user = $data['user'];

                // Save student details in session
                session([
                    'student_id'    => $user['id'] ?? null,
                    'student_email' => $user['email'] ?? null,
                    'student_name'  => ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''),
                    'api_token'     => $data['session_token'] ?? null,
                ]);

                return redirect()->route('posts.index')
                                 ->with('success', 'Welcome Student!');
            }

            return back()->withErrors([
                'login' => 'Login failed. Please check your credentials.',
            ]);

        } catch (ClientException $e) {
            return back()->withErrors([
                'login' => 'Login failed. Please check your credentials.',
            ]);
        }
    }

        public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to homepage instead of login form
        return redirect('/')->with('success', 'You have been logged out.');
    }

}
