@extends('layouts.master')

@section('title', 'Blog IT - Add Category')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4" style="border: 1px solid #80a8b0">
            @if (session('status'))
                <h5 class="alert alert-success mt-3">{{ session('status') }}</h5>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card-header" style="background-color: #80a8b0">
                <h4>Add a new category
                    {{-- <a href="{{ url('admin/category') }}" class="btn btn-sm btn-primary float-end">View Category</a> --}}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.add-category') }}" method="POST" enctype="multipart/form-data"
                    id="categoryForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>Category Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>* Category Name</label>
                                        <input type="text" name="name" class="form-control" autocomplete="off"
                                            id="categoryName">
                                        <small id="nameError" style="color: red; display: none;">Category name is
                                            required.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label>* Description</label>
                                        <textarea name="description" rows="9" class="form-control" id="description"></textarea>
                                        <small id="descriptionError" style="color: red; display: none;">Description is
                                            required.</small>
                                    </div>

                                    <div class="mb-2">
                                        <label>* Image</label>
                                        <input type="file" name="image" class="form-control" autocomplete="off"
                                            id="imageInput">
                                        <small id="imageError" style="color: red; display: none;">Please upload a valid
                                            image
                                            file
                                            (jpg,
                                            jpeg, png, gif).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>SEO Tags</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>* Meta Title</label>
                                        <input name="meta_title" class="form-control" autocomplete="off" id="metaTitle">
                                        <small id="metaTitleError" style="color: red; display: none;">Meta title is
                                            required.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label>* Meta Description</label>
                                        <textarea name="meta_description" rows="2" class="form-control" id="metaDescription"></textarea>
                                        <small id="metaDescriptionError" style="color: red; display: none;">Meta description
                                            is
                                            required.</small>
                                    </div>

                                    <div class="">
                                        <label>* Meta Keywords</label>
                                        <textarea name="meta_keyword" rows="2" class="form-control" id="metaKeywords"></textarea>
                                        <small id="metaKeywordsError" style="color: red; display: none;">Meta keywords are
                                            required.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>Status Mode</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="checkbox" name="navbar_status">
                                            <label>Hidden on the navbar</label>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="checkbox" name="status">
                                            <label>Hidden on the home page</label>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">Add Category</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- </form> --}}
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{ url('admin/category') }}" class="btn btn-primary float-start">View all category</a>
                    <button type="submit" class="btn btn-success float-end">Add this category</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Hàm thêm hoặc loại bỏ class cho trường nhập liệu
        function validateField(input, errorElement, isValid) {
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                errorElement.style.display = 'none';
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
            }
        }

        // Validate trường văn bản
        function validateTextField(input, errorElement) {
            const isValid = input.value.trim() !== '';
            validateField(input, errorElement, isValid);
            return isValid;
        }

        // Validate tệp ảnh
        function validateImageField(input, errorElement) {
            const validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (input.files.length > 0) {
                const fileName = input.files[0].name.toLowerCase();
                const fileExtension = fileName.split('.').pop();
                const isValid = validExtensions.includes(fileExtension);
                validateField(input, errorElement, isValid);
                return isValid;
            }
            validateField(input, errorElement, false);
            return false;
        }

        // Áp dụng sự kiện validate trực tiếp
        document.getElementById('categoryName').addEventListener('input', function() {
            validateTextField(this, document.getElementById('nameError'));
        });

        document.getElementById('description').addEventListener('input', function() {
            validateTextField(this, document.getElementById('descriptionError'));
        });

        document.getElementById('imageInput').addEventListener('change', function() {
            validateImageField(this, document.getElementById('imageError'));
        });

        document.getElementById('metaTitle').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaTitleError'));
        });

        document.getElementById('metaDescription').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaDescriptionError'));
        });

        document.getElementById('metaKeywords').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaKeywordsError'));
        });

        // Xử lý form submit
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const isNameValid = validateTextField(
                document.getElementById('categoryName'),
                document.getElementById('nameError')
            );
            const isDescriptionValid = validateTextField(
                document.getElementById('description'),
                document.getElementById('descriptionError')
            );
            const isImageValid = validateImageField(
                document.getElementById('imageInput'),
                document.getElementById('imageError')
            );
            const isMetaTitleValid = validateTextField(
                document.getElementById('metaTitle'),
                document.getElementById('metaTitleError')
            );
            const isMetaDescriptionValid = validateTextField(
                document.getElementById('metaDescription'),
                document.getElementById('metaDescriptionError')
            );
            const isMetaKeywordsValid = validateTextField(
                document.getElementById('metaKeywords'),
                document.getElementById('metaKeywordsError')
            );

            if (isNameValid && isDescriptionValid && isImageValid && isMetaTitleValid && isMetaDescriptionValid &&
                isMetaKeywordsValid) {
                // alert('Form submitted successfully!');
                this.submit();
            } else {
                // alert('Please fix the errors before submitting.');
            }
        });
    </script>
@endsection
