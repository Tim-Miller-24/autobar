<?php

namespace App\Cashbox\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Cashbox\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        $options = Option::query();

        // if no category has been selected, show no options
        if (! $form['item_id']) {
            return [];
        }

        // if a category has been selected, only show articles in that category
        if ($form['item_id']) {
            $options = $options->where('item_id', $form['item_id']);
        }

        if ($search_term) {
            $results = $options->where('title', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Option::find($id);
    }
}
