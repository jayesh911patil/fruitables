<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    @include('Admin/common/header-link')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('Admin/common/sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('Admin/common/navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span>Features
                        </h4>


                        <div class="card">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-header">Features</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="card-header text-end ">
                                        <a href="{{route('add-features')}}"
                                            class="btn bg-primary text-white"><b>ADD</b></a>
                                    </h5>
                                </div>
                            </div>
                            <table class="table table-striped yajra-datatables" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>


                        <!-- Footer -->
                        @include('Admin/common/footer')
                        <!-- / Footer -->
                        <script>
                            $(function () {
                                var table = $('.yajra-datatables').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{route('features')}}",
                                    columns: [
                                        {
                                            data: 'DT_RowIndex',
                                            name: 'DT_RowIndex'
                                        },
                                        {
                                            data: 'image',
                                            name: 'image',
                                        },
                                        {
                                            data: 'title',
                                            name: 'title',
                                        },
                                        {
                                            data: 'description',
                                            name: 'description',
                                        },
                                        {
                                            data: 'action',
                                            name: 'action',
                                            orderable: true,
                                            searchable: true,
                                        },
                                    ]
                                })
                            });
                        </script>
</body>

</html>