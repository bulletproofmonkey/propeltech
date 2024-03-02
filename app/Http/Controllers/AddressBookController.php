<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressBookRequest;
use App\Models\Address;
use App\Repository\AddressRepository;
use App\Repository\Exceptions\NotFoundException;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AddressBookController extends Controller
{
    /**
     * @var AddressRepository
     */
    private AddressRepository $addressRepository;

    /**
     * @param AddressRepository $addressRepository
     */
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function spa(): View
    {
        return view('spa', [
            'type'  => 'spa',
            'title' => '',
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('index', [
            'title'     => '',
            'search'    => $request->get('search'),
            'addresses' => $this->addressRepository->getAll($request->get('search')),
        ]);
    }

    /**
     * @param int $id
     * @return View
     * @throws NotFoundException
     */
    public function show(int $id): View
    {
        return view('address', [
            'title'   => 'View Address',
            'address' => $this->addressRepository->get($id),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('form', [
            'title'   => 'Add Address',
            'action'  => 'Add',
            'address' => null,
        ]);
    }

    /**
     * @param int $address
     * @return View
     * @throws NotFoundException
     */
    public function edit(int $address): View
    {
        return view('form', [
            'title'   => 'Edit Address',
            'action'  => 'Edit',
            'address' => $this->addressRepository->get($address),
        ]);
    }

    /**
     * @param AddressBookRequest $addressBookRequest
     * @param int|null $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(AddressBookRequest $addressBookRequest, int $id = null): RedirectResponse
    {
        $data = $addressBookRequest->validated();

        $address = (new Address())->fromArray($data);

        $this->addressRepository->store($address, $id);

        return redirect('/');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->addressRepository->remove($id);

        return redirect('/');
    }
}
