<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\ISBN;
use App\Models\User;

class ProfileController extends Controller
{
	/**
	 * Display the user's profile form.
	 */
	public function edit(Request $request): View
	{
		return view('profile.edit', [
			'user' => $request->user(),
		]);
	}

	/**
	 * Update the user's profile information.
	 */
	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit')->with('status', 'profile-updated');
	}

	/**
	 * Delete the user's account.
	 */
	public function destroy(Request $request): RedirectResponse
	{
		$request->validateWithBag('userDeletion', [
			'password' => ['required', 'current_password'],
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/');
	}

	//ADMIN PANEL FUNCTIONS
	public function index()
	{
		$isbns = ISBN::onlyTrashed()->get();
		$autors = Autor::onlyTrashed()->get();
		$libros = Libro::onlyTrashed()->get();
		$users = User::all();

		return view('profile.index', compact('libros', 'autors', 'isbns', 'users'));
	}

	public function restore(string $op, string $id)
	{
		if ($op == 'isbn') {
			$isbn = ISBN::withTrashed()->find($id);
			$isbnController = new ISBNController();
			$isbnController->restoreISBN($id);
		}elseif ($op == 'libro') {
			$libro = Libro::withTrashed()->find($id);
			$libro->restore();
		}elseif ($op == 'autor') {
			$autor = Autor::withTrashed()->find($id);
			$autor->restore();
		}

		$isbns = ISBN::onlyTrashed()->get();
		$autors = Autor::onlyTrashed()->get();
		$libros = Libro::onlyTrashed()->get();
		$users = User::all();

		return view('profile.index', compact('libros', 'autors', 'isbns', 'users'));
	}

	public function forceDelete(string $op, string $id)
	{
		if ($op == 'isbn') {
			$isbn = ISBN::withTrashed()->find($id);
			$isbn->forceDelete();
		}elseif ($op == 'libro') {
			$libro = Libro::withTrashed()->find($id);
			$libroController = new LibroController();
			$libroController->deleteLibroForever($id);
		}elseif ($op == 'autor') {
			$autor = Autor::withTrashed()->find($id);
			$autor->forceDelete();
		}elseif ($op == 'user') {
			$user = User::all()->find($id);
			$user->Delete();
		}

		$isbns = ISBN::onlyTrashed()->get();
		$autors = Autor::onlyTrashed()->get();
		$libros = Libro::onlyTrashed()->get();
		$users = User::all();

		return view('profile.index', compact('libros', 'autors', 'isbns', 'users'));
	}

	public function cambiarStatusAdmin(string $id)
	{
			
		$user = User::all()->find($id);
		$user->is_admin = !$user->is_admin;
		$user->save();

		$isbns = ISBN::onlyTrashed()->get();
		$autors = Autor::onlyTrashed()->get();
		$libros = Libro::onlyTrashed()->get();
		$users = User::all();

		return view('profile.index', compact('libros', 'autors', 'isbns', 'users'));
	}

}
