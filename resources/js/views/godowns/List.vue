<template>
  <div class="app-container">
    <div class="filter-container">
      <el-button class="filter-item" type="primary" icon="el-icon-plus" @click="handleCreateForm">
        {{ $t('table.add') }}
      </el-button>
    </div>
    <el-table v-loading="loading" :data="list" border fit highlight-current-row>
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Name" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Location">
        <template slot-scope="scope">
          <span>{{ scope.row.location }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Status">
        <template slot-scope="scope">
          <span>{{ scope.row.status }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <el-button type="primary" size="small" icon="el-icon-edit" @click="handleEditForm(scope.row.id);">
            Edit
          </el-button>
          <el-button type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id, scope.row.name);">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-dialog :title="formTitle" :visible.sync="godownFormVisible">
      <div class="form-container">
        <el-form ref="godownForm" :model="currentgodown" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Name" prop="name">
            <el-input v-model="currentgodown.name" />
          </el-form-item>
          <el-form-item label="Branch" prop="branch">
            <el-input v-model="currentgodown.branch" />
          </el-form-item>
          <el-form-item label="Location" prop="location">
            <el-input v-model="currentgodown.location" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="godownFormVisible = false">
            Cancel
          </el-button>
          <el-button type="primary" @click="handleSubmit()">
            Confirm
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
import Resource from '@/api/resource';
const godownResource = new Resource('godowns');
export default {
  name: 'Godown',
  data() {
    return {
      list: [],
      loading: true,
      godownFormVisible: false,
      currentgodown: {},
      formTitle: '',
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.loading = true;
      const { data } = await godownResource.list({});
      this.list = data;
      this.loading = false;
    },
    handleSubmit() {
      if (this.currentgodown.id !== undefined) {
        godownResource.update(this.currentgodown.id, this.currentgodown).then(response => {
          this.$message({
            type: 'success',
            message: 'godown info has been updated successfully',
            duration: 5 * 1000,
          });
          this.getList();
        }).catch(error => {
          console.log(error);
        }).finally(() => {
          this.godownFormVisible = false;
        });
      } else {
        godownResource
          .store(this.currentgodown)
          .then(response => {
            this.$message({
              message: 'New godown ' + this.currentgodown.name + ' has been created successfully.',
              type: 'success',
              duration: 5 * 1000,
            });
            this.currentgodown = {
              name: '',
              branch: '',
              location: '',
            };
            this.godownFormVisible = false;
            this.getList();
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    handleCreateForm() {
      this.godownFormVisible = true;
      this.formTitle = 'Create new godown';
      this.currentgodown = {
        name: '',
        branch: '',
        location: '',
      };
    },
    handleDelete(id, name) {
      this.$confirm('This will permanently delete godown ' + name + '. Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        godownResource.destroy(id).then(response => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          });
          this.getList();
        }).catch(error => {
          console.log(error);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    handleEditForm(id) {
      this.formTitle = 'Edit godown';
      this.currentgodown = this.list.find(godown => godown.id === id);
      this.godownFormVisible = true;
    },
  },
};
</script>
