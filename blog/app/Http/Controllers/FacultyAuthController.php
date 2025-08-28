<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class FacultyAuthController extends Controller
{
    private $baseURL = "https://pupt-registration.site";
    private $API_KEY = "pup_sjXDT8odELYV71pVfirvFRziLgs5G6y1_1755770032";

    public function showLoginForm()
    {
        return view('auth.faculty-login');
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

                // Save faculty details in session
                session([
                    'faculty_id'    => $user['id'] ?? null,
                    'faculty_email' => $user['email'] ?? null,
                    'faculty_name'  => ($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''),
                    'faculty_token' => $data['session_token'] ?? null,
                ]);

                return redirect()->route('posts.index')
                                 ->with('success', 'Welcome Faculty!');
            }

            return redirect()->route('faculty.login.form')->withErrors([
                'login' => 'Login failed. Please check your credentials.',
            ]);

        } catch (ClientException $e) {
            return redirect()->route('faculty.login.form')->withErrors([
                'login' => 'Login failed. Please check your credentials.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'You have been logged out.');
    }
}


