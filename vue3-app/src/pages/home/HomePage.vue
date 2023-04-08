<script lang="ts">
import { VDataTable } from "vuetify/labs/VDataTable";
import axios from "axios";

export default {
  name: "App",
  components: {
    VDataTable
  },
  data() {
    return {
      pageCount: 1,
      page: 1,
      itemsPerPage: 10,
      totalCount: 10,
      headers: [
        {
          title: "",
          key: ""
        },
        {
          title: "ID",
          key: "id",
        },
        {
          title: "Genus",
          key: "genus",
        },
        {
          title: "Name",
          key: "name",
        },
        {
          title: "Family",
          key: "family",
        },
        {
          title: "Order",
          key: "order",
        },
        {
          title: "Carbohydrates",
          key: "n_carbohydrates",
        },
        {
          title: "Protein",
          key: "n_protein",
        },
        {
          title: "Fat",
          key: "n_fat",
        },
        {
          title: "Calories",
          key: "n_calories",
        },
        {
          title: "Sugar",
          key: "n_sugar",
        },
      ],
      isLoading: false,
      rows: [],
      nameFilter: "",
      familyFilter: ""
    }
  },
  watch: {
    totalCount(val) {
      this.pageCount = Math.ceil(val / this.itemsPerPage);
    },
    nameFilter(val) {
      this.filterByName(val)
    },
    familyFilter(val) {
      this.filterByFamily(val)
    }
  },
  methods: {
    fetchData(name: string = "", family: string = "") {
      this.isLoading = true;
      axios.get("http://localhost:3001/fruit", {params: {name, family}}).then((res: any) => {
        this.isLoading = false;
        this.rows = res.data.rows;
        this.totalCount = parseInt(res.data.pages.totalCount);
      });
    },
    filterByName(name: string) {
      this.rows = this.rows.filter((row: any) => row.name === name);
    },
    filterByFamily(family: string) {
      this.rows = this.rows.filter((row: any) => row.family === family);
    },
    likeNotLike(fruitId: any) {
      console.log(fruitId);
    }
  },
  created() {
    this.fetchData();
  }
};
</script>

<template>
  <v-container>
    <v-data-table
      v-model:items-per-page="itemsPerPage"
      :headers="headers"
      :items="rows"
      :loading="isLoading"
      item-value="name"
      class="elevation-1"
    >
    <template v-slot:item="{ item }">
      <tr>
        <td><v-btn density="compact" icon="mdi-heart" @click="likeNotLike(item.columns.id)"></v-btn></td>
        <td>{{ item.columns.id }}</td>
        <td>{{ item.columns.genus }}</td>
        <td>{{ item.columns.name }}</td>
        <td>{{ item.columns.family }}</td>
        <td>{{ item.columns.order }}</td>
        <td>{{ item.columns.n_carbohydrates }}</td>
        <td>{{ item.columns.n_protein }}</td>
        <td>{{ item.columns.n_fat }}</td>
        <td>{{ item.columns.n_calories }}</td>
        <td>{{ item.columns.n_sugar }}</td>
      </tr>
    </template></v-data-table>
  </v-container>
</template>

<style scope>
.label-div {
  margin: 20px;
  display: flex;
  grid-gap: 15px;
  align-items: center;
}
.add-fruit {
  margin-left: auto;
  color: #fff;
  background-color: #ca4820;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 1rem;
}
</style>
