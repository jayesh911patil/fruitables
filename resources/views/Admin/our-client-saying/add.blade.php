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

            <div class="layout-page">

                <!-- Navbar -->
                @include('Admin/common/navbar')
                <!-- Navbar -->

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Add Our Client Saying</h5>
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        </div>
                                    </div>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <form action="{{route('add-store-our-client-saying')}}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            <div class="mb-3 col-md-6">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description"
                                                        id="description"></textarea>
                                                    @error('description')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input class="form-control" type="file" id="image" name="image"
                                                        autofocus />
                                                    @error('image')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input class="form-control" name="title" id="title"></input>
                                                    @error('title')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="position" class="form-label">Position</label>
                                                    <input type="text" class="form-control" name="position"
                                                        id="position"></input>
                                                    @error('position')
                                                        <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                @include('Admin/common/footer')
                <!-- / Footer -->

</body>

</html>