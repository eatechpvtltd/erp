@include('print.includes.print-layout')

<style>
    span.receipt-copy {
        font-size: 22px;
        font-weight: 600;
        background: black;
        color: white;
        padding: 3px 15px;
    }

    th{
        border-bottom: none !important;
        background: none !important;
        color: black;
    }
    .table-striped th{
        background: #d8d8d8 !important;
    }

    table th.head{
        background: #d8d8d8 !important;
        border-bottom: 1px solid black !important;
    }
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid rgba(221, 221, 221, 0.52);
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
        line-height: 1.2;
        vertical-align: top;
        border-top: 1px solid rgba(221, 221, 221, 0.52) !important;
    }
    .col-sm-12.align-right.hidden-print {
        position: fixed;
        z-index: 999;
    }

    @media print {
       /* thead {display: table-row;}*/
        .main-content{
            page-break-after:always !important;
        }
    }

</style>