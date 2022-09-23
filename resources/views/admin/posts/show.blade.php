@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Posts</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post {{$post->title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-2  mb-3">
                        <a href="{{route('admin.post.create')}}" class="btn btn-block btn-info btn-lg">Create</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">{{$post->title}}</h1>

                                <div class="card-tools row">
                                    <a href="{{route('admin.post.edit', $post->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{route('admin.post.destroy', $post->id)}}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent">
                                            <i class="fas fa-trash text-danger" role="button"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{$post->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{$post->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Content</th>
                                        <td>{{$post->content}}</td>
                                    </tr>
                                    <tr>
                                        <th>Preview image</th>
                                        <td><img src="{{asset('storage/' . $post->preview_image)}}" alt="preview_image" class="img-fluid"></td>
                                    </tr>
                                    <tr>
                                        <th>Main image</th>
                                        <td><img src="{{asset('storage/' . $post->main_image)}}" alt="main_image" class="img-fluid"></td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{$post->category_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Created at</th>
                                        <td>{{$post->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated at</th>
                                        <td>{{$post->updated_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Count of posts</th>
                                        <td>53443</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
