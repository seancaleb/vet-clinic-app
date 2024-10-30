<?php

namespace App\DataTables;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class AppointmentsDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        $user = request()->user();

        // Adjust the query based on user role
        if ($user->role === 'admin') {
            $query = Appointment::with('user')->orderBy('updated_at', 'desc');
        } else {
            $query = Appointment::with('user')->where('user_id', $user->id)->orderBy('created_at', 'desc');
        }

        $datatable = (new EloquentDataTable($query))
            ->addColumn('action', 'appointments.action')
            ->editColumn('description', function ($appointment) {
                return Str::words($appointment->description, 15);
            })
            ->editColumn('appointment_type', function ($appointment) {
                return ucfirst($appointment->appointment_type);
            })
            ->editColumn('appointment_date', function ($appointment) {
                return  Carbon::parse($appointment->appointment_date)->format('m/d/Y');
            })
            ->editColumn('status', function ($appointment) {
                return view('components.ui.badge-status', ['status' => $appointment->status])->with('slot', strtoupper($appointment->status))->render();
            })
            ->editColumn('payment_status', function ($appointment) {
                return view('components.ui.badge-status', ['status' => $appointment->payment_status])->with('slot', strtoupper($appointment->payment_status))->render();
            })
            ->rawColumns(['status', 'payment_status'])
            ->setRowId('id');

        if ($user->role === 'admin') {
            $datatable->addColumn('pet_owner', function ($appointment) {
                return $appointment->user->name;
            });
        }

        return $datatable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('appointments-table')
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
            Column::make('pet_name'),
            Column::make('description'),
            Column::make('appointment_type'),
            Column::make('appointment_date'),
            Column::make('status'),
            Column::make('payment_status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Appointments_' . date('YmdHis');
    }
}
