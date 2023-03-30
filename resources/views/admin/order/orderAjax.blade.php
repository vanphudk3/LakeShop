@foreach($transaction as $item)
                  
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        {{$item->id}}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="{{ asset('images/user.webp') }}"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold">{{$item->re_name}}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              Số điện thoại: {{$item->re_phone}}
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{number_format($item->total_price)}} VNĐ
                      </td>
                      <td class="px-4 py-3 text-xs">
                        @if($item->status == 'pending')
                        <span
                          style="background: red"
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          {{$item->status}}
                        </span>
                        @else
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          {{$item->status}}
                        </span>
                        @endif
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{$item->created_at}}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <a href="{{route('admin-order-detail',$item->id)}}">
                          <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                          >
                            Chi tiết
                          </span>
                        </a>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <form action="{{route('admin-order-delete',$item->id)}}" method="post" id="delete-order">
                          <span
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                          >
                            @csrf
                            @method('delete')
                            <button type="submit">Xóa</button>
                          </span>
                        </form>
                    </tr>
@endforeach