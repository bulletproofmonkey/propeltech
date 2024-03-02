$(document).ready(function () {
    const api = {
        baseUrl: '/api/',
        getAll: async function (search) {
            const response = await fetch(this.baseUrl + (search ? '?search=' + search : ''));
            return response.json();
        },
        get: async function (id) {
            const response = await fetch(this.baseUrl + id);
            return response.json();
        },
        create: async function (data) {
            const response = await fetch(this.baseUrl, {
                method: 'POST',
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data)
            });
            return response.json();
        },
        update: async function (id, data) {
            const response = await fetch(this.baseUrl + id, {
                method: 'PATCH',
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data)
            });
            return response.json();
        },
        delete: async function (id) {
            await fetch(this.baseUrl + id, {method: 'DELETE'});
            return true;
        },
    };

    const container = $('#addresses');
    const addressView = $('#addressView');
    const confirmDelete = $('#addressDeleteConfirm');
    const errors = $('#errors');
    const template = $('*[data-template=address]', container);

    let currentId = null;

    const form = {
        element: $('#addressForm'),
        clear: function () {
            $('input', this.element).val('');
            $('.alert').addClass('d-none');
            populateTable();
            currentId = null;
        },
        data: function() {
            const data = {};

            $('input', this.element).each(function () {
                const fieldName = $(this).attr('name');
                data[fieldName] = $(this).val();
            });
            return data;
        },
        hide: function() {
            $(this.element).modal('hide')
        },
        populate: function (address) {
            renderContent(address, this.element, 'form');
        }
    };

    const renderContent = function (content, element, type) {
        for (const key in content) {
            if (type === 'form') {
                $('input[name=' + key + ']', element).val(content[key]);
            } else {
                $('*[data-content=' + key + ']', element).html(content[key]);
            }
        }
    }

    const populateTable = function (search) {
        api.getAll(search)
            .then(function (addressBook) {
                $('tbody tr', container).each(function () {
                    if (!$(this).data('container')) {
                        $(this).remove();
                    }
                });

                $(addressBook).each(function (idx) {
                    let row = $(template)
                        .clone()
                        .removeClass('d-none')
                        .removeAttr('data-container')
                        .attr('data-id', idx)
                        .data('address', this);

                    renderContent(this, row);

                    $('tbody', container).append(row);
                });

                if (addressBook.length > 0) {
                    $(container).removeClass('d-none');
                    $('#empty').addClass('d-none');
                    $('#no-results').addClass('d-none');
                } else {
                    $(container).addClass('d-none');
                    if (search) {
                        $('#no-results').removeClass('d-none');
                    } else {
                        $('#empty').removeClass('d-none');
                    }
                }
            });
    }

    $(form.element).on('show.bs.modal', function (e) {
        let row = $(e.relatedTarget).parents('*[data-id]');
        if (row.length) {
            form.populate($(row).data('address'));
            currentId = $(row).attr('data-id');
        } else {
            form.clear();
        }
    });

    $('#save', form.element).on('click', function () {
        const saveHandler = function (response) {
            if (response.errors) {
                $(errors).removeClass('d-none');
                $('*[data-content]', errors).addClass('d-none');
                renderContent(response.errors, errors);
                for(const key in response.errors) {
                    $('*[data-content=' + key + ']', errors).removeClass('d-none');
                }
            } else {
                $(errors).addClass('d-none');
                populateTable('');
                form.hide();
            }
        }

        if (currentId) {
            api.update(currentId, form.data())
                .then(saveHandler);
        } else {
            api.create(form.data())
                .then(saveHandler);
        }
    });

    $(addressView).on('show.bs.modal', function (e) {
        let row = $(e.relatedTarget).parents('*[data-id]');
        if (row.length) {
            renderContent($(row).data('address'), addressView);
        }
    });

    $(confirmDelete).on('show.bs.modal', function (e) {
        let row = $(e.relatedTarget).parents('*[data-id]');
        if (row.length) {
            currentId = $(row).data('id');
            renderContent($(row).data('address'), confirmDelete);
        }
    });

    $('#delete', confirmDelete).on('click', function () {
        api.delete(currentId).then(function() {
            populateTable();
        });
        $(confirmDelete).modal('hide');
    });

    $('input[type=search]', container).on('keyup change', function () {
        populateTable($(this).val());
    });

    $('button[data-action=clear]').on('click', function() {
        $('input[type=search]').val('').trigger('change');
    });

    populateTable();

});
