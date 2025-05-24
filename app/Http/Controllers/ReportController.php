<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function printReceipt($pid)
    {
        $payment = Payment::find($pid);
        $pdf = App::make('dompdf.wrapper');
        $print = '<div style="margin: 20px; padding:20px;">';
        $print .= '<h1 style="text-align: center;">Payment Receipt</h1>';
        $print .= '<hr/>';
        $print .= '<p> Receipt No | <b>' . $pid . '</b></p>';
        $print .= '<p> Payment Date | <b>' . $payment->paid_date . '</b></p>';
        $print .= '<p> Enrollment No | <b>' . $payment->enrollment->enroll_no . '</b></p>';
        $print .= '<p> Student Name | <b>' . $payment->enrollment->student->name . '</b></p>';
        $print .= '<hr/>';
        $print .= '<table style="width: 100%; border-collapse: collapse;">';
        $print .= '<tr>';
        $print .= '<td>Batch</td>';
        $print .= '<td>Amount</td>';
        $print .= '</tr>';
        $print .= '<tr>';
        $print .= '<td><h3>' . $payment->enrollment->batch->name . '</td></h3>';
        $print .= '<td><h3>' . $payment->amount . '</td></h3>';
        $print .= '</table>';
        $print .= '<hr/>';

        $print .= "<span> Printed Date | <b>" . date('Y-m-d') . "</b></span>";
        $print .= '</div>';

        $pdf->loadHTML($print);
        return $pdf->stream('receipt.pdf');
    }
}
