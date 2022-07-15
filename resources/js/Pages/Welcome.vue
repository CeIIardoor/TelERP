<template>
  <Head>
    <meta
      type="description"
      content="TelERP, l'application de la gestion de vos abonnements téléphoniques."
      head-key="description"
    />
    <title>Index</title>
  </Head>
  <section class="h-screen">
    <div class="relative bg-gradient-to-b from-stone-100 to-white overflow-hidden">
      <div class="mx-auto">
        <div
          class="relative z-10 pb-8 bg-gradient-to-b from-stone-100 to-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full xl:pb-32"
        >
          <svg
            class="hidden z-20 lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
            fill="currentColor"
            viewBox="0 0 100 100"
            preserveAspectRatio="none"
            aria-hidden="true"
          >
            <polygon points="50,0 100,0 50,100 0,100" />
          </svg>

          <Popover>
            <div
              class="bg-gradient-to-b from-emerald-200 to-stone-100 relative pt-6 pb-3 px-4 sm:px-6 lg:px-8"
            >
              <nav
                class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                aria-label="Global"
              >
                <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                  <div class="flex items-center justify-between w-full md:w-auto">
                    <Link href="/">
                      <CubeTransparentIcon class="h-8 w-8 text-green-400" />
                    </Link>
                    <div class="-mr-2 flex items-center md:hidden">
                      <PopoverButton
                        class="bg-gradient-to-b from-stone-100 to-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-lime-500"
                      >
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                      </PopoverButton>
                    </div>
                  </div>
                </div>
                <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                  <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    class="font-medium text-gray-500 hover:text-gray-900"
                  >
                    {{ item.name }}
                  </Link>
                  <Link
                    v-if="authenticated"
                    href="/dashboard"
                    class="font-medium text-lime-600 hover:text-lime-500"
                  >
                    Dashboard
                  </Link>
                  <Link
                    v-else
                    href="/login"
                    class="font-medium text-lime-600 hover:text-lime-500"
                  >
                    Se connecter
                  </Link>
                </div>
              </nav>
            </div>

            <transition
              enter-active-class="duration-150 ease-out"
              enter-from-class="opacity-0 scale-95"
              enter-to-class="opacity-100 scale-100"
              leave-active-class="duration-100 ease-in"
              leave-from-class="opacity-100 scale-100"
              leave-to-class="opacity-0 scale-95"
            >
              <PopoverPanel
                focus
                class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
              >
                <div
                  class="rounded-lg shadow-md bg-gradient-to-b from-stone-100 to-white ring-1 ring-black ring-opacity-5 overflow-hidden"
                >
                  <div class="px-5 pt-4 flex items-center justify-between">
                    <div>
                      <Link href="/">
                        <HomeIcon class="h-8 w-8 mb-3 text-green-400" />
                      </Link>
                    </div>
                    <div class="-mr-2">
                      <PopoverButton
                        class="bg-gradient-to-b from-stone-100 to-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-lime-500"
                      >
                        <XIcon class="h-6 w-6" aria-hidden="true" />
                      </PopoverButton>
                    </div>
                  </div>
                  <div class="px-2 pt-2 pb-3 space-y-1">
                    <Link
                      v-for="item in navigation"
                      :key="item.name"
                      :href="item.href"
                      class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                      {{ item.name }}
                    </Link>
                  </div>
                  <Link
                    v-if="authenticated"
                    href="/dashboard"
                    class="block w-full px-5 py-3 text-center font-medium text-lime-600 bg-gray-50 hover:bg-gray-100"
                  >
                    Dashboard
                  </Link>
                  <Link
                    v-else
                    href="/login"
                    class="block w-full px-5 py-3 text-center font-medium text-lime-600 bg-gray-50 hover:bg-gray-100"
                  >
                    Se connecter
                  </Link>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>

          <main
            class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
          >
            <div class="sm:text-center lg:text-left">
              <h1
                class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl"
              >
                <span class="block xl:inline">MedinaTech</span>
                <br />
                <span class="block text-emerald-600 xl:inline">ERP abonnements</span>
              </h1>
              <p
                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
              >
                Une PWA qui regroupe l'ensemble des tâches liées à l'utilisation et à la
                gestion des abonnements téléphoniques au sein d'une organisation.
              </p>
            </div>
          </main>
        </div>
      </div>
      <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="w-full object-scale-down" src="/assets/img/index.jpg" alt="" />
      </div>
    </div>
  </section>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { MenuIcon, XIcon, HomeIcon, CubeTransparentIcon } from "@heroicons/vue/outline";
const navigation = [
  { name: "A propos", href: "/apropos" },
  { name: "Tarifs", href: "/tarifs" },
  { name: "Documentation", href: "/docs" },
];
export default {
  components: {
    Popover,
    PopoverButton,
    PopoverPanel,
    MenuIcon,
    XIcon,
    HomeIcon,
    CubeTransparentIcon,
  },
  setup() {
    return {
      navigation,
    };
  },
  computed: {
    authenticated() {
      return this.$page.props.auth.user != null;
    },
  },
};
</script>
