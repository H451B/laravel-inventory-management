<!DOCTYPE html>
<html lang="en">

{{-- HEAD --}}
<x-layouts.partials.head />
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <x-layouts.partials.navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-layouts.partials.sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 d-flex justify-content-start">
                            @isset($back)
                            <a class="m-0 pr-3" style="font-size: 1.3rem" href="{{route($back)}}"><i class="fas fa-chevron-left"></i></a>    
                            @endisset
                            
                            <h1 class="m-0">{{ isset($title) ? $title : 'Title' }}</h1>
                        </div><!-- /.col -->
                        
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- /.row -->
                    {{$slot}}
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- FOOTER --}}
        <x-layouts.partials.footer />
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <x-layouts.partials.scripts/>
</body>

</html>
