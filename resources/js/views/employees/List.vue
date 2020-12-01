<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input
        v-model="query.keyword"
        :placeholder="$t('table.keyword')"
        style="width: 200px;"
        class="filter-item"
        @keyup.enter.native="handleFilter"
      />
      <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
      <el-button
        class="filter-item"
        style="margin-left: 10px;"
        type="primary"
        icon="el-icon-plus"
        @click="handleCreate"
      >
        {{ $t('table.add') }}
      </el-button>
      <!--      <el-button-->
      <!--        v-waves-->
      <!--        :loading="downloading"-->
      <!--        class="filter-item"-->
      <!--        type="primary"-->
      <!--        icon="el-icon-download"-->
      <!--        @click="handleDownload"-->
      <!--      >-->
      <!--        {{ $t('table.export') }}-->
      <!--      </el-button>-->
    </div>

    <el-table
      ref="multipleTable"
      v-loading="loading"
      :data="list"
      border
      fit
      highlight-current-row
      style="width: 100%"
      @selection-change="handleSelectionChange"
    >
      <el-table-column align="center" type="selection" width="55" />
      <el-table-column align="center" prop="index" sortable label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.index }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" prop="name" label="Name" sortable>
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" prop="emp_type" label="Employee Type" sortable>
        <template slot-scope="scope">
          <span>{{ scope.row.emp_type }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" prop="salary" label="Salary" sortable>
        <template slot-scope="scope">
          <span>{{ scope.row.salary }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="status" :label="$t('table.status')" class-name="status-col" width="100" sortable>
        <template slot-scope="scope">
          <el-tag :type="scope.row.status | statusFilter" v>
            {{ scope.row.status===1 ? 'Active' : 'Inactive' }}
          </el-tag>
        </template>
      </el-table-column>
      <!--            <el-table-column align="center" prop="status" :label="$t('table.status')" class-name="status-col" sortable>-->
      <!--                <template slot-scope="scope">-->
      <!--                    <el-switch v-model="scope.row.status" :active-value="1" :inactive-value="0"-->
      <!--                               @change="changeStatus(scope.row.id, $event)"> {{ scope.row.status }}-->
      <!--                    </el-switch>-->
      <!--                </template>-->
      <!--            </el-table-column>-->

      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <el-button type="primary" size="small" icon="el-icon-edit" @click="handleEdit(scope.row.id);">
            {{ $t('table.edit') }}
          </el-button>
          <el-button v-if="scope.row.status===0" size="mini" type="success" @click="handleModifyStatus(scope.row, 1)">
            {{ $t('table.active') }}
          </el-button>
          <el-button v-else size="mini" type="danger" @click="handleModifyStatus(scope.row,0)">
            {{ $t('table.inactive') }}
          </el-button>
          <el-button
            type="danger"
            size="small"
            icon="el-icon-delete"
            @click="handleDelete(scope.row.id, scope.row.name);"
          >
            {{ $t('table.delete') }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <pagination
      v-show="total>0"
      :total="total"
      :page.sync="query.page"
      :limit.sync="query.limit"
      @pagination="getList"
    />

    <el-dialog :title="formTitle" :visible.sync="dialogFormVisible">
      <div v-loading="employeeCreating" class="form-container">
        <el-form
          ref="employeeForm"
          :rules="rules"
          :model="currentEmployee"
          label-position="left"
          label-width="150px"
          style="max-width: 500px;"
        >

          <el-form-item :label="$t('employee.name')" prop="name">
            <el-input v-model="currentEmployee.name" />
          </el-form-item>
          <el-form-item :label="$t('employee.emp_type')" prop="emp_type">
            <el-select
              v-model="currentEmployee.emp_type"
              class="filter-item"
              placeholder="Please select Type"
            >
              <el-option
                v-for="item in employee_types"
                :key="item"
                :label="item | uppercaseFirst"
                :value="item"
              />
            </el-select>
          </el-form-item>
          <el-form-item :label="$t('employee.salary')" prop="salary">
            <el-input v-model="currentEmployee.salary" />
          </el-form-item>
          <el-form-item :label="$t('employee.status')" prop="status">
            <el-switch
              v-model="currentEmployee.status"
              :active-value="1"
              :inactive-value="0"
              @change="changeStatus(currentEmployee.id,$event)"
            />
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible = false">
            {{ $t('table.cancel') }}
          </el-button>
          <el-button type="primary" @click="handleSubmit()">
            {{ $t('table.confirm') }}
          </el-button>
        </div>
      </div>
    </el-dialog>
  </div>
</template>

<script>
	import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
	import Resource from '@/api/resource';
	import waves from '@/directive/waves'; // Waves directive
	// import permission from '@/directive/permission'; // Permission directive
	// import checkPermission from '@/utils/permission'; // Permission checking

	const employeeResource = new Resource('employees');
	// const permissionResource = new Resource('permissions');

	export default {
		name: 'EmployeeList',
		components: { Pagination },
		directives: { waves },
		filters: {
			statusFilter(status) {
				const statusMap = {
					1: 'success',
					0: 'warning',
				};
				return statusMap[status];
			},
			// typeFilter(type) {
			// 	return calendarTypeKeyValue[type];
			// },
		},
		data() {
			return {
				list: null,
				total: 0,
				loading: true,
				downloading: false,
				employeeCreating: false,
				formTitle: '',
				multipleSelection: [],
				query: {
					page: 1,
					limit: 15,
					keyword: '',
					// role: '',
				},
				// roles: ['admin', 'manager', 'editor', 'employee', 'visitor'],
				employee_types: ['Manager', 'Worker', 'Guard', 'Accountant', 'Driver'],
				dialogFormVisible: false,
				currentEmployee: {},
				rules: {
					emp_type: [{ required: true, message: 'Employee Type is required', trigger: 'change' }],
					name: [{ required: true, message: 'Name is required', trigger: 'blur' }],
				},
			};
		},
		created() {
			// this.resetNewEmployee();
			this.getList();
			// if (checkPermission(['manage permission'])) {
			//   this.getPermissions();
			// }
		},
		methods: {
			handleSelectionChange(val) {
				this.multipleSelection = val;
			},
			async getList() {
				const { limit, page } = this.query;
				this.loading = true;
				const { data, meta } = await employeeResource.list(this.query);
				this.list = data;
				this.list.forEach((element, index) => {
					element['index'] = (page - 1) * limit + index + 1;
				});
				this.total = meta.total;
				this.loading = false;
			},
			handleFilter() {
				this.query.page = 1;
				this.getList();
			},
			handleModifyStatus(row, status) {
                row.status = status;
                console.log(row);
				employeeResource.update(row.id, row).then(response => {
					this.$message({
						message: 'Status Changed Successfully!',
						type: 'success',
					});
				}).catch(error => {
					console.log(error);
				});
			},
			handleCreate() {
				// this.resetNewEmployee();
				this.dialogFormVisible = true;
				this.formTitle = 'Create new Employee';
				this.currentEmployee = {
					name: '',
					emp_type: '',
					salary: '',
					status: '',
				};
				this.$nextTick(() => {
					this.$refs['employeeForm'].clearValidate();
				});
			},
			handleEdit(id) {
				this.formTitle = 'Edit Employee';
				this.currentEmployee = this.list.find(employee => employee.id === id);
				this.dialogFormVisible = true;
			},
			handleDelete(id, name) {
				this.$confirm('This will permanently delete employee ' + name + '. Continue?', 'Warning', {
					confirmButtonText: 'OK',
					cancelButtonText: 'Cancel',
					type: 'warning',
				}).then(() => {
					employeeResource.destroy(id).then(response => {
						this.$message({
							type: 'success',
							message: 'Delete completed',
						});
						this.handleFilter();
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
			handleSubmit() {
				if (this.currentEmployee.id !== undefined) {
					employeeResource.update(this.currentEmployee.id, this.currentEmployee).then(response => {
						this.$message({
							type: 'success',
							message: 'Employee info has been updated successfully',
							duration: 5 * 1000,
						});
						this.getList();
					}).catch(error => {
						console.log(error);
					}).finally(() => {
						this.dialogFormVisible = false;
					});
				} else {
					this.$refs['employeeForm'].validate((valid) => {
						if (valid) {
							// this.newEmployee.roles = [this.newEmployee.role];
							this.employeeCreating = true;
							employeeResource
								.store(this.currentEmployee)
								.then(response => {
									this.$message({
										message: 'New employee ' + this.newEmployee.name + ' has been created successfully.',
										type: 'success',
										duration: 5 * 1000,
									});
									// this.resetNewEmployee();
									this.dialogFormVisible = false;
									this.handleFilter();
								})
								.catch(error => {
									console.log(error);
								})
								.finally(() => {
									this.employeeCreating = false;
								});
						} else {
							console.log('error submit!!');
							return false;
						}
					});
				}
			},
			// resetNewEmployee() {
			//   this.newEmployee = {
			//     name: '',
			//     emp_type: '',
			//     salary: '',
			//     status: '',
			//   };
			// },
			// handleDownload() {
			//   this.downloading = true;
			// 			import('@/vendor/Export2Excel').then(excel => {
			// 			  const tHeader = ['id', 'employee_id', 'name', 'email', 'role'];
			// 			  const filterVal = ['index', 'id', 'name', 'email', 'role'];
			// 			  const data = this.formatJson(filterVal, this.list);
			// 			  excel.export_json_to_excel({
			// 			    header: tHeader,
			// 			    data,
			// 			    filename: 'employee-list',
			// 			  });
			// 			  this.downloading = false;
			// 			});
			// },
			formatJson(filterVal, jsonData) {
				return jsonData.map(v => filterVal.map(j => v[j]));
			},
			changeStatus(id, $event) {
				// employeeResource.changeStatus(id).then(response => {
				//   this.$message({
				//     type: 'success',
				//     message: 'Status Updated!!!',
				//   });
				//   this.handleFilter();
				// }).catch(error => {
				//   console.log(error);
				// });
				// let status = event.status;
				// console.log(status);
				console.log($event);
				// console.log(num);
			},

		},
	};
</script>

<style lang="scss" scoped>
    .edit-input {
        padding-right: 100px;
    }

    .cancel-btn {
        position: absolute;
        right: 15px;
        top: 10px;
    }

    .dialog-footer {
        text-align: left;
        padding-top: 0;
        margin-left: 150px;
    }

    .app-container {
        flex: 1;
        justify-content: space-between;
        font-size: 14px;
        padding-right: 8px;

        .block {
            float: left;
            min-width: 250px;
        }

        .clear-left {
            clear: left;
        }
    }
</style>
