<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use Illuminate\Http\Request;

class BoardMemberController extends Controller
{
    public function index(Request $request)
    {
        // 1. Opsi Filter Periode (Manual saja agar sesuai format IYES)
        $periods = ['2027/2028', '2025/2026', '2023/2024'];

        // 2. Ambil Pilihan User (Default ke yang terbaru)
        $currentPeriod = $request->period ?? '2025/2026';

        // 3. Query Data
        $members = BoardMember::query()
            ->where(function ($query) use ($currentPeriod) {
                // LOGIKA: Ambil Founder ATAU Cek dalam JSON array periode
                $query->where('is_founder', true)
                    ->orWhereJsonContains('period', $currentPeriod);
            })
            ->orderBy('sort_order', 'asc') // Urutan hierarki
            ->get();

        // 4. Grouping Divisi (Sesuai Urutan Konstanta)
        $groupedMembers = $members->groupBy('division')->sortBy(function ($items, $key) {
            $orderList = array_keys(BoardMember::DIVISIONS);
            $index = array_search($key, $orderList);
            return $index === false ? 99 : $index;
        });

        return view('board-members.index', compact('groupedMembers', 'periods', 'currentPeriod'));
    }
}