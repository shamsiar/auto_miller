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

      <el-table-column align="center" label="Branch" width="200">
        <template slot-scope="scope">
          <span>{{ scope.row.branch }}</span>
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
    <el-dialog :title="formTitle" :visible.sync="bankFormVisible">
      <div class="form-container">
        <el-form ref="bankForm" :model="currentBank" label-position="left" label-width="150px" style="max-width: 500px;">
          <el-form-item label="Name" prop="name">
            <el-input v-model="currentBank.name" />
          </el-form-item>
          <el-form-item label="Branch" prop="branch">
            <el-input v-model="currentBank.branch" />
          </el-form-item>
          <el-form-item label="Location" prop="location">
            <el-input v-model="currentBank.location" />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="bankFormVisible = false">
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
const bankResource = new Resource('banks');
export default {
  name: 'Bank',
  data() {
    return {
      list: [],
      loading: true,
      bankFormVisible: false,
      currentBank: {},
      formTitle: '',
    };
  },
  created() {
    this.getList();
  },
  methods: {
    async getList() {
      this.loading = true;
      const { data } = await bankResource.list({});
      this.list = data;
      this.loading = false;
    },
    handleSubmit() {
      if (this.currentBank.id !== undefined) {
        bankResource.update(this.currentBank.id, this.currentBank).then(response => {
          this.$message({
            type: 'success',
            message: 'Bank info has been updated successfully',
            duration: 5 * 1000,
          });
          this.getList();
        }).catch(error => {
          console.log(error);
        }).finally(() => {
          this.bankFormVisible = false;
        });
      } else {
        bankResource
          .store(this.currentBank)
          .then(response => {
            this.$message({
              message: 'New Bank ' + this.currentBank.name + ' has been created successfully.',
              type: 'success',
              duration: 5 * 1000,
            });
            this.currentBank = {
              name: '',
              branch: '',
              location: '',
            };
            this.bankFormVisible = false;
            this.getList();
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    handleCreateForm() {
      this.bankFormVisible = true;
      this.formTitle = 'Create new bank';
      this.currentBank = {
        name: '',
        branch: '',
        location: '',
      };
    },
    handleDelete(id, name) {
      this.$confirm('This will permanently delete bank ' + name + '. Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        bankResource.destroy(id).then(response => {
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
      this.formTitle = 'Edit bank';
      this.currentBank = this.list.find(bank => bank.id === id);
      this.bankFormVisible = true;
    },
  },
};
</script>
