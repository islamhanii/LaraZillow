<template>
    <form>
        <div class="my-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Price from" class="input-filter input-filter-left" />
                <input type="text" placeholder="Price to" class="input-filter input-filter-right" />
            </div>
            <div class="flex flex-nowrap items-center">
                <select class="input-filter input-filter-left">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
                <select class="input-filter input-filter-right">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option>6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Area from" class="input-filter input-filter-left" />
                <input type="text" placeholder="Area to" class="input-filter input-filter-right" />
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-normal">Filter</button>
                <button type="reset">Clear</button>
            </div>
        </div>
    </form>
</template>
