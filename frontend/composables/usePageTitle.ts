import { inject, ref, provide, type Ref } from 'vue'

const PAGE_TITLE_KEY = Symbol('pageTitle')

export function providePageTitle(defaultTitle = 'Dashboard') {
  const title = ref(defaultTitle)
  provide(PAGE_TITLE_KEY, title)
  return title
}

export function usePageTitle() {
  const title = inject(PAGE_TITLE_KEY) as Ref<string> | undefined
  if (!title) throw new Error('usePageTitle must be used within a layout that calls providePageTitle')
  return title
}
