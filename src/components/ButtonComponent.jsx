import React from 'react'
import { twMerge } from 'tailwind-merge'

export default function ButtonComponent({ className, href, disabled, children, ...props }) {
  const Component = href ? 'a' : 'button'

  return (
    <Component
      className={twMerge('bg-blue-700 text-white font-bold px-4 py-2 rounded ', disabled ? 'bg-gray-400 cursor-not-allowed' : 'hover:bg-blue-800', className)}
      {...props}
    >
      {children}
    </Component>
  )
}