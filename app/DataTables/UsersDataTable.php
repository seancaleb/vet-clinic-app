<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        function get_total_appointments($count) {
            if ($count === 0) {
                return 'N/A';
            } elseif ($count === 1) {
                return "{$count} appointment";
            } else {
                return "{$count} appointments";
            }
        }

        $query = User::with('appointments')->where('id', '!=', Auth::id())->orderBy('updated_at', 'desc');

        $datatable =  (new EloquentDataTable($query))
            ->addColumn('action', 'users.action')
            ->editColumn('role', function ($user) {
                return ucfirst($user->role);
            })
            ->addColumn('number_of_appointments', function ($user) {
                return get_total_appointments($user->appointments->count());
            })
            ->editColumn('created_at', function ($user) {
                return  Carbon::parse($user->created_at)->format('m/d/Y');
            })
            ->addColumn('status', function ($user) {
                if (empty($user->email_verified_at)) {
                    return view('components.ui.badge-status', ['status' => 'not-verified'])->with('slot', strtoupper('Not Verified'))->render();
                } else {
                    return view('components.ui.badge-status', ['status' => 'verified'])->with('slot', strtoupper('Verified'))->render();
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword);

                $query->where(function ($q) use ($keyword) {
                    if (strpos('verified', $keyword) !== false) {
                        $q->whereNotNull('email_verified_at');
                    }

                    if (strpos('not verified', $keyword) !== false) {
                        $q->orWhereNull('email_verified_at');
                    }
                });
            })
            ->rawColumns(['status'])
            ->setRowId('id');

        return $datatable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Users_' . date('YmdHis');
    }
}
