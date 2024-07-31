import React from 'react'
import { useRouteError } from "react-router-dom"
import ContainerComponent from '../components/ContainerComponent'
import TitleComponent from '../components/TitleComponent'

export default function ErrorPage() {
  const error = useRouteError()

  const errorStatus = error.status || 500
  const errorMessage = error.data?.message || error.message || 'An error occurred'

  return (
    <ContainerComponent className='py-6 text-center'>
      <TitleComponent className='mb-4'>Error {errorStatus}</TitleComponent>
      <p>{errorMessage}</p>
    </ContainerComponent>
  )
}
