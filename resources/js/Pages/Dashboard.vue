<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reporting</h2>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
            <div>Données calculés du coté client (JS)</div>
            <div>
              <select
                name="organisation_id"
                id="organisation_id"
                class="rightshadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-emerald-600 focus:border-emerald-600 block p-2.5 pr-8 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                placeholder="Organisation"
                v-model="org_id"
                @change="getOrgData"
              >
                <option :value="null" disabled selected>Choisir une organisation</option>
                <option
                  v-for="organisation in organisations"
                  :key="organisation.id"
                  :value="organisation.id"
                >
                  {{ organisation.intitule }}
                </option>
              </select>
            </div>
          </div>
          <div class="p-6 bg-white border-b border-gray-200">
            <LineChart class="chart" :option="FacturesChartOptions" :key="org_id" />
          </div>
        </div>
        <hr />
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            Données calculés du coté serveur (PHP)
          </div>
          <div class="p-6 bg-white border-b border-gray-200">
            <PieChart class="chart" :option="ForfaitsChartOptions" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import PieChart from "@/Charts/PieChart.vue";
import LineChart from "@/Charts/LineChart.vue";

const props = defineProps({
  forfaitsfixe: Number,
  forfaitsmobile: Number,
  forfaitsinternet: Number,
  factures: Object,
  organisations: Object,
  abonnements: Object,
});

let org_id = $ref(null);

let legend_data = $ref([]);

let abonnement_series = $ref([]);

const ForfaitsChartOptions = $ref({
  title: {
    text: "Types de forfaits",
    left: "center",
  },
  tooltip: {
    trigger: "item",
    formatter: "{a} <br/>{b} : {c} ({d}%)",
  },
  legend: {
    orient: "vertical",
    left: "left",
    data: ["Internet", "Mobile", "Fixe"],
  },
  series: [
    {
      name: "Traffic Sources",
      type: "pie",
      radius: "75%",
      center: ["50%", "60%"],
      data: [
        { value: props.forfaitsinternet, name: "Internet" },
        { value: props.forfaitsmobile, name: "Mobile" },
        { value: props.forfaitsfixe, name: "Fixe" },
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 20,
          shadowColor: "rgba(0, 0, 0, 0.5)",
        },
        shadowOffsetX: 0,
      },
    },
  ],
});

const FacturesChartOptions = $ref({
  title: {
    text: "Cout des factures par organisation",
  },
  tooltip: {
    trigger: "axis",
  },
  legend: {
    data: legend_data,
  },
  grid: {
    left: "3%",
    right: "4%",
    bottom: "3%",
    containLabel: true,
  },
  toolbox: {
    feature: {
      saveAsImage: {},
    },
  },
  xAxis: {
    type: "category",
    boundaryGap: false,
    data: [
      "Jan",
      "Févr",
      "Mars",
      "Avr",
      "Mai",
      "Juin",
      "Juil",
      "Août",
      "Sept",
      "Oct",
      "Nov",
      "Déc",
    ],
  },
  yAxis: {
    type: "value",
  },
  series: abonnement_series,
});

function getOrgData() {
  abonnement_series.splice(0);
  legend_data.splice(0);

  let abonnementsfiltres = props.abonnements.filter(
    (abonnement) => abonnement.organisation_id == org_id
  );

  abonnementsfiltres.forEach((abonnement) => {
    abonnement_series.push({
      name: abonnement.numero_ligne,
      type: "line",
      stack: "Total",
      data: [120, 132, 101, 134, 90, 230, 210, 120, 132, 101, 134, 90],
    });
    legend_data.push(abonnement.numero_ligne);
  });
  console.log(abonnement_series, legend_data);
}
</script>
