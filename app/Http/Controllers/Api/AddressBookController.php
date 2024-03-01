<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressBookRequest;
use App\Http\Responses\JsonResponse;
use App\Models\Address;
use App\Repository\AddressRepository;
use App\Repository\Exceptions\MismatchedEntityException;
use App\Repository\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        return new JsonResponse($this->addressRepository->getAll($request->get('search')));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function get(int $id): JsonResponse
    {
        return new JsonResponse($this->addressRepository->get($id));
    }

    /**
     * @param AddressBookRequest $addressBookRequest
     * @return JsonResponse
     * @throws MismatchedEntityException
     * @throws NotFoundException
     */
    public function create(AddressBookRequest $addressBookRequest): JsonResponse
    {
        return $this->update($addressBookRequest);
    }

    /**
     * @param AddressBookRequest $addressBookRequest
     * @param int|null $id
     * @return JsonResponse
     * @throws MismatchedEntityException
     * @throws NotFoundException
     */
    public function update(AddressBookRequest $addressBookRequest, ?int $id = null): JsonResponse
    {
        $data = $addressBookRequest->validated();

        $address = (new Address())->fromArray($data);

        $id = $this->addressRepository->store($address, $id);

        return new JsonResponse($this->addressRepository->get($id));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->addressRepository->remove($id);

        return new Response('', 204);
    }
}
