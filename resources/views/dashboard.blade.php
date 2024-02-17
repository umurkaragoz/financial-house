<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Transactions</h1>
                            <p class="mt-2 text-sm text-gray-700">You can adjust filters to inspect transactions.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4 mt-4">

                        <div>
                            <label for="fromDate" class="block text-sm font-medium leading-6 text-gray-900">From Date</label>
                            <div class="mt-2">
                                <input type="date" name="fromDate" id="fromDate" value="{{ Carbon\Carbon::now()->subYears(10)->format('Y-m-d') }}"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="toDate" class="block text-sm font-medium leading-6 text-gray-900">To Date</label>
                            <div class="mt-2">
                                <input type="date" name="toDate" id="toDate" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                            <div class="mt-2">
                                <select id="status" name="status"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">ALL</option>
                                    <option value="APPROVED">APPROVED</option>
                                    <option value="WAITING">WAITING</option>
                                    <option value="DECLINED">DECLINED</option>
                                    <option value="ERROR">ERROR</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="operation" class="block text-sm font-medium leading-6 text-gray-900">Operation</label>
                            <div class="mt-2">
                                <select id="operation" name="operation"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">ALL</option>
                                    <option value="DIRECT">DIRECT</option>
                                    <option value="REFUND">REFUND</option>
                                    <option value="3D">3D</option>
                                    <option value="3DAUTH">3DAUTH</option>
                                    <option value="STORED">STORED</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="paymentMethod" class="block text-sm font-medium leading-6 text-gray-900">Payment Method</label>
                            <div class="mt-2">
                                <select id="paymentMethod" name="paymentMethod"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">ALL</option>
                                    <option value="CREDITCARD">CREDITCARD</option>
                                    <option value="CUP">CUP</option>
                                    <option value="IDEAL">IDEAL</option>
                                    <option value="GIROPAY">GIROPAY</option>
                                    <option value="MISTERCASH">MISTERCASH</option>
                                    <option value="STORED">STORED</option>
                                    <option value="PAYTOCARD">PAYTOCARD</option>
                                    <option value="CEPBANK">CEPBANK</option>
                                    <option value="CITADEL">CITADEL</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="errorCode" class="block text-sm font-medium leading-6 text-gray-900">Error Code</label>
                            <div class="mt-2">
                                <select id="errorCode" name="errorCode"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">ALL</option>
                                    <option value="Do not honor">Do not honor</option>
                                    <option value="Invalid Transaction">Invalid Transaction</option>
                                    <option value="Invalid Card">Invalid Card</option>
                                    <option value="Not sufficient funds">Not sufficient funds</option>
                                    <option value="Incorrect PIN">Incorrect PIN</option>
                                    <option value="Invalid country association">Invalid country association</option>
                                    <option value="Currency not allowed">Currency not allowed</option>
                                    <option value="3-D Secure Transport Error">3-D Secure Transport Error</option>
                                    <option value="Transaction not permitted to cardholder">Transaction not permitted to cardholder</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="filterField" class="block text-sm font-medium leading-6 text-gray-900">Filter Field</label>
                            <div class="mt-2">
                                <select id="filterField" name="filterField"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option value="">ALL</option>
                                    <option value="Transaction UUID">Transaction UUID</option>
                                    <option value="customerEmail">Customer Email</option>
                                    <option value="Reference No">Reference No</option>
                                    <option value="Custom Data">Custom Data</option>
                                    <option value="Card PAN">Card PAN</option>
                                </select>
                            </div>
                        </div>


                        <div>
                            <label for="filterValue" class="block text-sm font-medium leading-6 text-gray-900">Filter Value</label>
                            <div class="mt-2">
                                <input type="text" name="filterValue" id="filterValue"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <button type="button" id="filter-btn"
                                    class="mt-8 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Filter Data
                            </button>
                        </div>


                    </div>

                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table id="transactions-table" class="hover:table-auto min-w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Merchant</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Customer</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Customer Email</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Transaction Time</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Operation</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Transaction ID</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <template id="table-row">
        <tr class="even:bg-gray-50">
            <td class="whitespace-nowrap px-3 py-3 text-sm font-medium text-gray-900 sm:pl-3"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"></td>
            <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-500"><a href="" target="_blank" class="text-blue-500"></a></td>
        </tr>
    </template>


    <x-slot name="scripts">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const filterBtn = document.querySelector('#filter-btn')

                filterBtn.addEventListener('click', () => {
                    getTransactions()
                })

                getTransactions()
            })

            function getFilterValues() {
                const fromDateFilter      = document.querySelector('#fromDate')
                const toDateFilter        = document.querySelector('#toDate')
                const statusFilter        = document.querySelector('#status')
                const operationFilter     = document.querySelector('#operation')
                const paymentMethodFilter = document.querySelector('#paymentMethod')
                const errorCodeFilter     = document.querySelector('#errorCode')
                const filterFieldFilter   = document.querySelector('#filterField')
                const filterValueFilter   = document.querySelector('#filterValue')

                return {
                    fromDate     : fromDateFilter.value,
                    toDate       : toDateFilter.value,
                    status       : statusFilter.options[statusFilter.selectedIndex].value,
                    operation    : operationFilter.options[operationFilter.selectedIndex].value,
                    paymentMethod: paymentMethodFilter.options[paymentMethodFilter.selectedIndex].value,
                    errorCode    : errorCodeFilter.options[errorCodeFilter.selectedIndex].value,
                    filterField  : filterFieldFilter.options[filterFieldFilter.selectedIndex].value,
                    filterValue  : filterValueFilter.value,
                }
            }

            function getFilteredUrl() {
                const url          = new URL(window.location.origin + '/dashboard/get-transactions')
                const filterValues = getFilterValues()
                for (const filter in filterValues) {
                    url.searchParams.set(filter, filterValues[filter])
                }

                return url.toString()
            }

            function getTransactions() {
                const table            = document.querySelector('#transactions-table')
                const tableBody        = table.querySelector('tbody')
                const tableRowTemplate = document.querySelector('#table-row')

                tableBody.innerHTML = ''

                axios({
                    method: 'get',
                    url   : getFilteredUrl(),
                }).then(response => {
                    if(!response.data) {
                        return;
                    }

                    for (const transaction of response.data) {
                        const newRow         = tableRowTemplate.content.cloneNode(true)
                        const columns        = newRow.querySelectorAll('td')
                        
                        columns[0].innerText = transaction?.merchant?.name
                        columns[1].innerText = transaction?.customerInfo?.billingFirstName + ' ' + transaction?.customerInfo?.billingLastName
                        columns[2].innerText = transaction?.customerInfo?.email
                        columns[3].innerText = transaction?.created_at
                        columns[4].innerText = transaction?.transaction?.merchant?.status
                        columns[5].innerText = transaction?.transaction?.merchant?.operation

                        const transactionIdLink = columns[6].querySelector('a')
                        const transactionId = transaction?.transaction?.merchant?.transactionId
                        transactionIdLink.innerText = transactionId
                        transactionIdLink.href = window.location.origin + '/dashboard/transaction-detail/' + transactionId

                        tableBody.appendChild(newRow)
                    }
                })
            }
        </script>
    </x-slot>
</x-app-layout>
