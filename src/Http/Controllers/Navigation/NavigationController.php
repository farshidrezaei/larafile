<?php


namespace FarshidRezaei\LaraFile\Http\Controllers\Navigation;


use FarshidRezaei\LaraFile\Exceptions\DirectoryNotFoundException;
use FarshidRezaei\LaraFile\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NavigationController extends Controller
{
    public function getDir(Request $request)
    {
        $rootPath = config('larafile.root');
        $path = public_path($rootPath . $request->input('path', '/'));
        if(File::isDirectory($path)){
            return File::directories($path);
        }
        else{
            throw new DirectoryNotFoundException();
        }
    }
}
