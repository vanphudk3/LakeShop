<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hóa Đơn - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('js/init-alpine.js')}}"></script>
    @extends('layout.pages')
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"s
    >
      <!-- Desktop sidebar -->
      @include('admin.layout.header')
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Hoá Đơn
            </h2>
            <!-- CTA -->
            <!-- <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="https://github.com/estevanmaito/windmill-dashboard"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  ></path>
                </svg>
                <span>Star this project on GitHub</span>
              </div>
              <span>View more &RightArrow;</span>
            </a> -->

            <!-- With avatar -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Danh sách hoá đơn
            </h4>
            <div class="flex flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2" style="bottom: 15px;">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <form action="" id="frmsearch-order">
                  
                  <input
                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="text"
                    name="search"
                    placeholder="Tìm kiếm theo mã hoá đơn"
                    aria-label="Search"
                    id="rangePrimary"
                  />
                </form>
              </div>
            </div>
            @if(session('success'))
            <div class="px-4 py-3 mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Success!</strong>
              <span class="block sm:inline">{{session('success')}}</span>
            </div>
            @endif
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs" id="table_user">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">ID</th>
                      <th class="px-4 py-3">Client</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Action</th>
                      <th class="px-4 py-3">Delete</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    id="user"
                  >
                    @foreach($transaction as $item)
                    <tr class="row-order_{{$item->id}} text-gray-700 dark:text-gray-400 ">
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
                            <button type="button" class="delete-order" value="{{$item->id}}">Xóa</button>
                          </span>
                        </form>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                <span class="flex items-center col-span-3">
                  Showing
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Previous"
      
                        >
                          <svg
                            aria-hidden="true"
                            class="w-4 h-4 fill-current"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                      <li>
                        
                        <?php for($i=1;$i<=$number;$i++): ?>
                        <a class="page-link" href="{{route('admin-process-page-order')}}?page=<?php echo $i ?>">{{ $i }}
                          <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                          >
                        </button>
                        </a>
                        <?php endfor ?>
                      </li>
                      
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Next"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </nav>
                </span>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.delete-order').click(function(){
        var id = $(this).val();

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{route('admin-order-delete')}}',
              type: 'GET',
              data: {id: id},
              dataType: 'json',
              success: function(data){
                $status = data.status;
                $message = data.message;
                if($status==true){
                  $('.row-order_'+id).hide();
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                  
                }
              },
              error: function(error){
                console.log(error);
              }
            });
          }
        })
      });
    });
  </script>
</html>
