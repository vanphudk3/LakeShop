<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Addition product - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('css/tailwind.output.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{asset('js/init-alpine.js')}}"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="{{asset('images/admin/create-account-office.jpeg')}}"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="{{asset('images/admin/create-account-office-dark.jpeg')}}"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
              Edit product
              </h1>
              <form action="{{ route('admin-product-update',$product) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="size_id" value="1">
                <input type="hidden" name="discount" value="1">
                <input type="hidden" name="status" value="active">
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Tên Sản Phẩm</span>
                  <input
                    name="name"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="abc"
                    value="{{$product->name}}"
                  />
                </label>
                <label class="block mt-4 text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Giá</span>
                  <input
                    name="price"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="320.000"
                    value="{{$product->price}}"
                  />
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Miêu Tả</span>
                  <textarea name="description" id="" cols="30" rows="10" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="height: 37px">
                    {{$product->description}}
                  </textarea>
                </label>
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Đặt Biệt</span>
                  <textarea name="special" id="" cols="30" rows="10" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="height: 37px">
                    {{$product->special}}
                  </textarea>
                </label>
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Bảo Quản</span>
                  <textarea name="preserve" id="" cols="30" rows="10" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="height: 37px">
                    {{$product->preserve}}
                  </textarea>
                </label>
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Số lượng</span>
                  <input
                    name="quantity"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    type="number"
                    min="0"
                    value="{{$product->quantity}}"
                  />
                </label>
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Chọn Hình</span>
                  <input
                    name="image"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    type="file"
                    value="{{$product->image}}"
                  />
                  <input type="hidden" id="myFile" name="images" value="{{$product->image}}">
                </label>
                <hr class="my-8" />
                <!-- You should use a button here, as the anchor is only used for the example  -->
                <button
                  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  type="submit"
                >
                  Update
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
