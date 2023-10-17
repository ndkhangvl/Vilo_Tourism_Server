<div class="content">
    <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer" onclick="toggleDropDown()">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-black uppercase">Chi phí</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="fas fa-angle-down"></i>
            </span>
        </div>
    </div>
    <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto transition-all duration-300 transform origin-top"
        id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Social</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Friends</h1>
    </div>
</div>

<div class="content">
    <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center" onclick="dropDown1()">
            <span class="text-[15px] ml-4 text-black uppercase">Loại hình du lịch</span>
            <span class="text-sm rotate-180" id="arrow1">
                <i class="fas fa-angle-down"></i>
            </span>
        </div>
    </div>
    <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu1">
        <div class="checkbox ">
            <input id="price-free" type="checkbox" name="price" value="0-0" />
            <label class="pd-l-10" for="price-free">Miễn phí</label>
            <span class="badge pull-right"></span>
        </div>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Friends</h1>
    </div>
</div>

<div class="content">
    <div class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center" onclick="dropDown2()">
            <span class="text-[15px] ml-4 text-black uppercase">Dịch vụ</span>
            <span class="text-sm rotate-180" id="arrow21">
                <i class="fas fa-angle-down"></i>
            </span>
        </div>
    </div>
    <div class="leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu2">
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Social</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-gray-700 rounded-md mt-1">Friends</h1>
    </div>
</div>

<script>
    function toggleDropDown() {
        const submenu = document.getElementById('submenu');
        const arrow = document.getElementById('arrow');
        const icon = document.getElementById('icon');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
        icon.classList.toggle('rotate-icon');
    }

    function dropDown1() {
        const submenu = document.getElementById('submenu1');
        const arrow = document.getElementById('arrow1');
        const icon = document.getElementById('icon');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
        icon.classList.toggle('rotate-icon');
    }

    function dropDown2() {
        const submenu = document.getElementById('submenu2');
        const arrow = document.getElementById('arrow21');
        const icon = document.getElementById('icon');

        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
        icon.classList.toggle('rotate-icon');
    }

    function Openbar() {
        document.querySelector('.sidebar').classList.toggle('left-[-300px]')
    }
</script>
