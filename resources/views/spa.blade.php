@extends('layout', ['js' => true])

@section('content')
    <div>
        <div id="empty" class="d-none">
            There are no addresses, click
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addressForm">Add</button> to create one.
        </div>
        <div id="no-results" class="d-none">
            There are no matching addresses for <b data-content="search"></b>
            <button type="button" class="btn btn-success" data-action="clear">Clear Filter</button>
        </div>
        <div id="addresses" class="d-none">
            <form>
                <input type="search" name="search" placeholder="Search..." value="">
            </form>

            <table class="w-100">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addressForm">Add</button>
                    </th>
                </tr>
                </thead>
                <tbody>

                <tr data-template="address" data-id="" class="d-none">
                    <td data-content="first_name"></td>
                    <td data-content="last_name"></td>
                    <td data-content="phone"></td>
                    <td data-content="email"></td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addressView">View</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addressForm">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addressDeleteConfirm">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" role="dialog" id="addressView" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Address</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>First name</dt>
                        <dd data-content="first_name"></dd>

                        <dt>Last name</dt>
                        <dd data-content="last_name"></dd>

                        <dt>Email</dt>
                        <dd data-content="email"></dd>

                        <dt>Phone</dt>
                        <dd data-content="phone"></dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" role="dialog" id="addressForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Address</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="errors" class="alert alert-danger d-none">
                        <ul>
                            <li class="d-none" data-content="first_name"></li>
                            <li class="d-none" data-content="last_name"></li>
                            <li class="d-none" data-content="phone"></li>
                            <li class="d-none" data-content="email"></li>
                        </ul>
                    </div>

                    <form>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input class="form-control" name="first_name" id="first_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input class="form-control" name="last_name" id="last_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input class="form-control" name="phone" id="phone" type="text">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" role="dialog" id="addressDeleteConfirm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Address</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete the address for
                        <span data-content="first_name"></span>
                        <span data-content="last_name"></span>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>

@stop
